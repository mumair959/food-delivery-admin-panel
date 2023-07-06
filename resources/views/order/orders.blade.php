@extends('layouts.admin.layout')

@section('content')
<div ng-controller="orderCtrl" ng-init="init()">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-archive"></i> Orders</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Orders</a></li>
    </ul>
  </div>
  <div class="card shadow" style="padding: 15px">
    
        <div class="row">
          <div class="col-md-10">
            <h3>Orders</h3>
          </div>
        </div>
        <hr>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Order Status</th>
              <th>Amount</th>                    
              <th>Order Item</th>
              {{-- <th>Payment Status</th> --}}
              <th>Order On</th>                 
              <th>Order Duration</th>                            
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="order in orders">
              <td>@{{order.customer.user.first_name +' '+order.customer.user.last_name}}</td>
              <td>@{{order.order_status}}</td>
              <td>Rs. @{{order.net_amount}}</td>          
              <td>
                <span ng-click="openOrderDetail(order)" class="badge badge-success" style="padding: 8px 10px; border-radius: 15px">@{{order.order_items_count}}</span>
              </td>
              {{-- <td>@{{order.payment_status}}</td>  --}}
              <td>@{{order.order_on}}</td>                   
              <td>@{{order.order_duration}}</td>                            
            </tr>
          </tbody>
        </table>
    
        <ul class="pagination justify-content-end">
          <li class="page-item">
            <a ng-if="previous != null" class="page-link" ng-click="gotoPage(previous)" ng-model="previous" href="javascript:void(0)">Previous</a>
          </li>
          <li class="page-item">
            <a ng-if="next != null" class="page-link" ng-click="gotoPage(next)" ng-model="next" href="javascript:void(0)">Next</a>
          </li>
        </ul>
    
      </div>

      {{-- Order detail modal --}}
      <div class="modal" id="orderDetailModal">
          <div class="modal-dialog">
            <div class="modal-content">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Order Detail</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body">
                  <p><strong>Customer Name: </strong>@{{orderInfo.customer_name}}</p>
                  <p><strong>Contact#: </strong>@{{orderInfo.phone_num}}</p>
                  <p><strong>Address: </strong>@{{orderInfo.address}}</p>
                  <p><strong>Delivery Fee: </strong>Rs. @{{orderInfo.delivery_fee}}</p>
                  <p><strong>VAT: </strong>Rs. @{{orderInfo.vat}}</p>
                  <p><strong>Promocode Amount: </strong>Rs. <span ng-if="orderInfo.promocode_fare == null">0</span> <span ng-if="orderInfo.promocode_fare != null">@{{orderInfo.promocode_fare}}</span></p>
                  <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>Product Name</th>
                          <th>Vendor</th> 
                          <th>Qty.</th>                          
                          <th>Unit Price</th>                               
                          <th>Price</th>                           
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="detail in orderDetail">
                          <td>
                            @{{detail.product.name}} <br>
                            <small ng-if="detail.product_variant != null">(
                              <span *ng-if="detail.product_variant.variant_val_1 != null">@{{detail.product_variant.variant_val_1}}</span> 
                              <span *ng-if="detail.product_variant.variant_val_2 != null">@{{detail.product_variant.variant_val_2}}</span>  
                              <span *ng-if="detail.product_variant.variant_val_3 != null">@{{detail.product_variant.variant_val_3}}</span>                                
                            )</small>
                          </td>
                          <td>@{{detail.vendor.vendor_name}}</td>   
                          <td>@{{detail.quantity}}</td>                          
                          <td>Rs. @{{detail.product.net_price}}</td>                                                    
                          <td>Rs. @{{detail.net_price}}</td>                           
                        </tr>

                        <tr>
                          <td colspan="4">Total</td>                          
                          <td>Rs. @{{orderInfo.net_amount}}</td>                           
                        </tr>
                      </tbody>
                    </table>
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Approve</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
        
            </div>
          </div>
        </div>
      {{-- Order detail modal --}}
</div>

@endsection

@section('scripts')

<script src="{{ asset('js/angular-app/app2.js')}} "></script>
<script src="{{ asset('js/angular-app/controllers/order/orderCtrl.js')}} "></script>

@endsection
