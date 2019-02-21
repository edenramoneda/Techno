<?php
    include('home.php');

    $query = "SELECT * FROM order_request INNER JOIN products ON products.product_id = order_request.product_id WHERE order_request.req_status = 'Pending' ";
    $OnProcess = "SELECT * FROM order_request INNER JOIN products ON products.product_id = order_request.product_id WHERE order_request.req_status = 'On Process' ORDER BY order_request.updated_at DESC";
    $Delivered = "SELECT * FROM order_request INNER JOIN products ON products.product_id = order_request.product_id WHERE order_request.req_status = 'Delivered' ORDER BY order_request.updated_at DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();//execute select query
    $result = $stmt->fetchAll();
    $num_rows = $stmt->rowCount();//return no. of rows

    $stmtOP = $pdo->prepare($OnProcess);
    $stmtOP->execute();//execute select query
    $resultOP = $stmtOP->fetchAll();
    $num_rowsOP = $stmtOP->rowCount();//return no. of rows

    $stmtD = $pdo->prepare($Delivered);
    $stmtD->execute();//execute select query
    $resultD = $stmtD->fetchAll();
    $num_rowsD = $stmtD->rowCount();//return no. of rows
?>
<div class="container-fluid">
    <h4 class="mt-3">Ordering</h4>
    <ul class="nav nav-tabs mt-5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#order_req">Order Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#order_p">On Process</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#order_d">Delivered</a>
        </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="order_req" class="container-fluid tab-pane active"><br>
        <div class="card">
            <div class="card-body">
                    <div class="table-responsive" id="tableProduct" style="width:100%;">
                        <?php 
                            echo '
                            <table class="table table-hover table-sm table-bordered">
                                <thead class="thead-light"></thead>
                                    <tr>
                                        <th colspan="4">Date Requested</th>
                                        <th colspan="4">Full Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Additinal Note</th>
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
                                            <td colspan="4">' .$row['created_at'].'</td>
                                            <td colspan="4">' .$row['full_name'].'</td>
                                            <td>' .$row['email'].'</td>
                                            <td>' .$row['contact_number'].'</td>
                                            <td>' .$row['product_name']. '</td>
                                            <td>' .$row['quantity']. '</td>
                                            <td>' .$row['req_status']. '</td>
                                            <td>' .substr($row['additional_note'],0,10). '....</td>
                                            <td>
                                                <button type="button" data-orid="'.$row['or_id']. '"data-fullname="'.$row['full_name'].'"
                                                data-email="'.$row['email']. '" data-contactnumber="'.$row['contact_number']. '" data-productname="' .$row['product_name']. '"
                                                data-quantity="' .$row['quantity'].'" data-additionalnote="' .$row['additional_note']. '" data-status="' .$row['req_status'].  '"
                                                data-toggle="modal" data-target="#OrderRequestModal"
                                                class="btn btn-mybutton btn-sm" title="Update Status"><i class="fa fa-handshake"></i></button>
                                                &ensp;
                                           <!--     <button type="button" class="btn btn-sm btn-mybutton" title="Message ' .$row['full_name']. '"><i class="fa fa-envelope"></i></button>-->
                                            </td>
                                        </tr>
                                        ';
                                    }
                                }else{
                                    echo '
                                        <tr>
                                            <td colspan="16">No Pending Orders</td>
                                        </tr>';
                                    } 
                                
                                ?>
                            </tbody>
                <?php echo '</table>'; ?>
                    </div>
            </div>
        </div>
        <div class="modal fade" id="OrderRequestModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Order Request</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary form-order-req-success">
                            Order Status Updated!
                        </div>
                        <form method="POST" id="OrderRequestForm">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="or_id" id="or_id">
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" disabled>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" name="email" disabled>
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number" disabled>
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" disabled>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" disabled>
                            </div>
                            <div class="form-group">
                                <label>Additional Note</label>
                                <textarea class="form-control" id="additional_note" name="additional_note" rows="3" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option>Pending</option>
                                    <option>On Process</option>
                                    <option>Delivered</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update" class="btn btn-ess btn-sm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="order_p" class="container-fluid tab-pane fade"><br>
        <div class="card">
            <div class="card-body">
                    <div class="table-responsive" id="tableProduct" style="width:100%;">
                        <?php 
                            echo '
                            <table class="table table-hover table-sm table-bordered">
                                <thead class="thead-light"></thead>
                                    <tr>
                                        <th colspan="4">Date Requested</th>
                                        <th colspan="4">Full Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Additinal Note</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>';
                                ?>
                                 <tbody>
                                <?php if($num_rowsOP > 0) { 
                                    $countOP = 0;
                                    foreach($resultOP as $rowOP)
                                    {
                                        $countOP = $countOP + 1;
                                        echo '
                                        <tr>
                                            <td colspan="4">' .$rowOP['created_at'].'</td>
                                            <td colspan="4">' .$rowOP['full_name'].'</td>
                                            <td>' .$rowOP['email'].'</td>
                                            <td>' .$rowOP['contact_number'].'</td>
                                            <td>' .$rowOP['product_name']. '</td>
                                            <td>' .$rowOP['quantity']. '</td>
                                            <td>' .$rowOP['req_status']. '</td>
                                            <td>' .substr($rowOP['additional_note'],0,10). '....</td>
                                            <td>
                                                <button type="button" data-oporid="'.$rowOP['or_id']. '"data-opfullname="'.$rowOP['full_name'].'"
                                                data-opemail="'.$rowOP['email']. '" data-opcontactnumber="'.$rowOP['contact_number']. '" data-opproductname="' .$rowOP['product_name']. '"
                                                data-opquantity="' .$rowOP['quantity'].'" data-opadditionalnote="' .$rowOP['additional_note']. '" data-opstatus="' .$rowOP['req_status'].  '"
                                                data-toggle="modal" data-target="#OrderProcessModal"
                                                class="btn btn-mybutton btn-sm" title="Update Status"><i class="fa fa-handshake"></i></button>
                                                &ensp;
                                              <!--  <button type="button" class="btn btn-sm btn-mybutton" title="Message ' .$rowOP['full_name']. '"><i class="fa fa-envelope"></i></button>-->
                                            </td>
                                        </tr>
                                        ';
                                    }
                                }else{
                                    echo '
                                        <tr>
                                            <td colspan="16">No On Process Orders</td>
                                        </tr>';
                                    } 
                                
                                ?>
                            </tbody>
                <?php echo '</table>'; ?>
                    </div>
            </div>
        </div>
        <div class="modal fade" id="OrderProcessModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">On Process Order</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary form-order-req-success">
                            Order Status Updated!
                        </div>
                        <form method="POST" id="OrderProcessForm">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="on_p_or_id" id="on_p_or_id">
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" id="on_p_full_name" name="on_p_full_name" disabled>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="on_p_email" name="on_p_email" disabled>
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" id="on_p_contact_number" name="on_p_contact_number" disabled>
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" id="on_p_product_name" name="product_name" disabled>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control" id="on_p_quantity" name="on_p_quantity" disabled>
                            </div>
                            <div class="form-group">
                                <label>Additional Note</label>
                                <textarea class="form-control" id="on_p_additional_note" name="on_p_additional_note" rows="3" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="on_p_status" id="on_p_status" class="form-control">
                                    <option>Pending</option>
                                    <option>On Process</option>
                                    <option>Delivered</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update" class="btn btn-ess btn-sm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                           
    </div>
    <div id="order_d" class="container-fluid tab-pane fade"><br>
        <div class="card">
            <div class="card-body">
                    <div class="table-responsive" id="tableProduct" style="width:100%;">
                        <?php 
                            echo '
                            <table class="table table-hover table-sm table-bordered">
                                <thead class="thead-light"></thead>
                                    <tr>
                                        <th colspan="4">Date Requested</th>
                                        <th colspan="4">Full Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Additinal Note</th>
                                   <!--     <th>Action</th>-->
                                    </tr>
                                </thead>';
                                ?>
                                 <tbody>
                                <?php if($num_rowsD > 0) { 
                                    $countD = 0;
                                    foreach($resultD as $rowD)
                                    {
                                        $countD = $countD + 1;
                                        echo '
                                        <tr>
                                            <td colspan="4">' .$rowD['created_at'].'</td>
                                            <td colspan="4">' .$rowD['full_name'].'</td>
                                            <td>' .$rowD['email'].'</td>
                                            <td>' .$rowD['contact_number'].'</td>
                                            <td>' .$rowD['product_name']. '</td>
                                            <td>' .$rowD['quantity']. '</td>
                                            <td>' .$rowD['req_status']. '</td>
                                            <td>' .substr($rowD['additional_note'],0,10). '....</td>
                                          <!--  <td>
                                                <button type="button" class="btn btn-sm btn-mybutton" title="Message ' .$rowD['full_name']. '"><i class="fa fa-envelope"></i></button>
                                            </td>-->
                                        </tr>
                                        ';
                                    }
                                }else{
                                    echo '
                                        <tr>
                                            <td colspan="16">No Delivered Orders</td>
                                        </tr>';
                                    } 
                                
                                ?>
                            </tbody>
                <?php echo '</table>'; ?>
                    </div>
            </div>
        </div>
    </div>
  </div>

</div>