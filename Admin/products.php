<?php
    include('home.php');
    
    $query = "SELECT * FROM products ORDER BY created_at DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute();//execute select query
    $result = $stmt->fetchAll();

    $num_rows = $stmt->rowCount();//return no. of rows

?>
<div class="container-fluid">
    <h4 class="mt-3">Products</h4>
    <div class="card mt-5">
        <div class="card-header">
            <p><strong>Products:</strong> 
                <?php echo $num_rows ?>
                <button type="button" class="btn btn-ess" data-toggle="modal" data-target="#AddProduct" onclick="iFrameOn()">Add Product</button>
            </p>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="tableProduct">
            <?php 
                echo '
                <table class="table table-hover table-sm table-bordered">
                    <thead class="thead-light"></thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>';
                    ?>
                    <tbody>
                        <?php if($num_rows > 0) { 
                            $count = 0;
                            foreach($result as $row)
                            {
                                $count = $count + 1;
                                echo '
                                <tr>
                                
                                    <td>' .$row['product_name']. ' </td>
                                    <td id="row'.$count.'">' . htmlspecialchars_decode($row['product_description']) . ' </td>
                                    <td><img src="../image/' .$row['product_image']. '" class="img-thumbnail" id="oldImg" width="100" height="100"> </td>
                                    <td><button type="button" class="btn btn-mybutton btn-sm" data-productid="'.$row['product_id'].'"
                                    data-productname="'.$row['product_name'].'" data-productdesc="row'.$count.'" data-productimg="'.$row['product_image'].'"
                                     data-toggle="modal" data-target="#EditProduct">Edit</button>&ensp;
                                    <button type="button" data-dropproductid="'.$row['product_id'].'" data-toggle="modal" data-target="#DropProduct"
                                    class="btn btn-danger btn-sm">Drop</button>
                                    </td>
                                </tr>
                                ';
                            }
                        }else{
                            echo '
                                <tr>
                                    <td colspan="6">No Results Found</td>
                                </tr>';
                            } 
                        
                        ?>
                     
                    </tbody>
        <?php echo '</table>'; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="addProductForm" enctype="multipart/form-data">
                        <div class="alert alert-primary form-product-success">
                            Product Added!
                        </div>
                        <div class="alert alert-danger form-product-err">
                            All Fields are Required!
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name">
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <div id="wysiwg" class="btn-group btn-group-sm">
                                <button type="button" class="btn w-button" onclick="iBold()" title="Bold"><i class="fa fa-bold" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iUnderline()" title="Underline"><i class="fa fa-underline" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iItalic()" title="Italic"><i class="fa fa-italic" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iHorizontalRule()" title="horizontal-rule">HR</button>
                                <button type="button" class="btn w-button" onclick="iUnorderedList()" title="Unordered-list"><i class="fa fa-list-ul" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iOrderedList()" title="Ordered-list"><i class="fa fa-list-ol" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iLink()" title="Link"><i class="fa fa-link" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iUnlink()" title="Unlink"><i class="fa fa-unlink" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iIndent()" title="Indent"><i class="fa fa fa-indent" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iOutdent()" title="Outdent"><i class="fa fa fa-outdent" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iAlignCenter()" title="align-center"><i class="fa fa-align-center" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iAlignJustify()" title="align-justify"><i class="fa fa-align-justify" aria-hidden="true"></i></button><br>
                                <button type="button" class="btn w-button" onclick="iAlignLeft()" title="align-left"><i class="fa fa-align-left" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iAlignRight()" title="align-right"><i class="fa fa-align-right" aria-hidden="true"></i></button>
                            </div><br>
                            <div class="form-control text-left" id="product_desc" contenteditable>

                            </div>
                            <input type="text" name="product_desc" id="pDescTemp" hidden/>
                            <!--<iframe name="iframeproduct" class="form-control" id="iframeproduct" style = "width: 500; height: 400;"></iframe>-->
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="product_img" id="product_image">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-ess" value="Submit" name="SubmitProduct">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="EditProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="EditProductForm" enctype="multipart/form-data">
                        <div class="alert alert-primary form-updateproduct-success">
                            Product Modified!
                        </div>
                        <div class="alert alert-danger form-updateproduct-err">
                            All Fields are Required!
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product_id" id="product_id_e">
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name_e">
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <div id="wysiwg" class="btn-group btn-group-sm">
                                <button type="button" class="btn w-button" onclick="iBold()" title="Bold"><i class="fa fa-bold" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iUnderline()" title="Underline"><i class="fa fa-underline" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iItalic()" title="Italic"><i class="fa fa-italic" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iHorizontalRule()" title="horizontal-rule">HR</button>
                                <button type="button" class="btn w-button" onclick="iUnorderedList()" title="Unordered-list"><i class="fa fa-list-ul" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iOrderedList()" title="Ordered-list"><i class="fa fa-list-ol" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iLink()" title="Link"><i class="fa fa-link" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iUnlink()" title="Unlink"><i class="fa fa-unlink" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iIndent()" title="Indent"><i class="fa fa fa-indent" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iOutdent()" title="Outdent"><i class="fa fa fa-outdent" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iAlignCenter()" title="align-center"><i class="fa fa-align-center" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iAlignJustify()" title="align-justify"><i class="fa fa-align-justify" aria-hidden="true"></i></button><br>
                                <button type="button" class="btn w-button" onclick="iAlignLeft()" title="align-left"><i class="fa fa-align-left" aria-hidden="true"></i></button>
                                <button type="button" class="btn w-button" onclick="iAlignRight()" title="align-right"><i class="fa fa-align-right" aria-hidden="true"></i></button>
                            </div><br>
                            <div class="form-control text-left" id="product_desc_e" contenteditable>
                            </div>
                            <input type="text" name="product_desc_e" id="pDescTemp_e" hidden/>
                         <!--   <textarea class="form-control" name="product_desc_e" id="product_desc_e" rows="3">
                            </textarea>-->
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" class="form-control" name="product_img_e" id="product_image_e">
                        </div>
                        <div class="form-group">
                            <img src="" id="product_image_prev" width="100" height="100"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-ess" value="Update" name="UpdateProduct">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DropProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" id="DropProductForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="drop_pID" name="drop_pID">
                        </div>
                        <div class="form-group">
                            <label>Are you sure you want to drop this product?</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-mybutton btn-sm" value="Yes">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>&ensp;
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>