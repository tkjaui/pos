<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <!-- The form -->
      <div class="col-sm-4">
        <div class="box box-success">
          <div class="box-header with-border"></div>
          <!-- <form role="form" method="post" class="saleForm"> -->
            <div class="box-body">
              <div class="box">
                <!-- Seller input -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="" id="newSeller" required>
                      <option value="">施術者を選択</option>
                      <?php
                        $item = null;
                        $value = null;
                        $users = ControllerUsers::ctrShowUsers($item, $value);

                        foreach ($users as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                        }
                      ?>
                      </select>
                    <input type="hidden" name="idSeller" value="<?php echo $_SESSION["id"];?>"> 
                  </div>
                </div>

                <!-- Code input -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    
                    <?php
                      $item = null;
                      $value = null;
                      $sales = ControllerSales::ctrShowSales($item, $value);

                      if(!$sales){
                        echo '<input type="text" class="form-control" name="" id="newSale" value="10001" readonly>';
                      } else {
                        foreach ($sales as $key => $value) {
                        }
                        $code = $value["code"] +1;
                        echo '<input type="text" class="form-control" name="" id="newSale" value="'.$code.'" readonly>';
                      }
                    ?>
                  </div>
                </div>
                <!-- Customer input -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control" name="" id="selectCustomer">
                      <option value="" style="font-size:10px;">お客様を選択</option>

                      <?php
                        $item = null;
                        $value = null;
                        $customers = ControllerCustomers::ctrShowCustomers($item, $value);

                        foreach ($customers as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                        }
                      ?>

                    </select>
                    <span class="input-group-addon">
                      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddCustomer" data-dismiss="modal">
                        お客様追加
                      </button>
                    </span>
                  </div>
                </div>
                
                <!-- Product input -->
                <div class="form-group row newProduct"></div>
                <input type="hidden" name="" id="productsList">

                

                <div class="form-group"></div>
                <input type="hidden" name="product_sum_price" id="product_sum_price">
                
                <!-- Add service button -->
                <!-- <button type="button" class="btn btn-default hidden-lg btnAddService">サービスを追加</button> -->
                <!-- Add product button -->
                <!-- <button type="button" class="btn btn-default hidden-lg btnAddProduct">商品を追加</button> -->
                <!-- <hr> -->
                <div class="row">
                  <!-- Taxes and total input -->
                  <div class="col-xs-10 pull-right">
                    <table class="table">
                      <thead>
                        <th>税率</th>
                        <th>合計</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="width:50%">
                            <div class="input-group">
                              <input type="number" class="form-control " name="newTaxSale" id="newTaxSale" placeholder="0" min="0" value="0" required>
                              <input type="hidden" name="" id="newTaxPrice" required>
                              <input type="hidden" name="" id="newNetPrice" required>
                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                            </div>
                          </td>
                          <td style="width:50%">
                            <div class="input-group">
                              <input type="text" class="form-control " name="newSaleTotal" id="newSaleTotal" placeholder="0" totalSale="" readonly required>
                              <input type="hidden" name="" id="saleTotal" required>
                              <span class="input-group-addon">円</span>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- <hr> -->
                </div>
                <!-- <hr> -->
                
                <!-- <br> -->
              </div>
            </div>
            <!-- <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-left">会計をする</button>
            </div> -->
            <div class="box-footer">
              <!-- <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#addSales">支払いへ</button> -->
            </div>
          </form>

          <?php
            // $saveSale = new ControllerSales();
            // $saveSale -> ctrCreateSale();
          ?>

        </div>
      </div>
      <!-- Products table -->
      <div class="col-sm-8" >
        <div class="tab-wrap">
          <!-- 美容 -->
          <input id="TAB-01" type="radio" name="TAB" class="tab-switch" checked="checked" /><label class="tab-label" for="TAB-01">美容</label>
          <div class="tab-content">

          <?php
            $colors = array("#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900");

            $item = null;
            $value = null;
            $categories = controllerCategories::ctrShowCategories($item, $value);
              // var_dump($categories[0]["Category"]);
              for($i=0; $i<count($categories); $i++){
                if($categories[$i]["id"] <= 12 ||
                  $categories[$i]["id"] == 25 ){
                  echo '<div class="product" >
                  <div class="l-wrapper_02 card-radius_02" style="background-color: '.$colors[$i].'">
                  <p class="card__title_02" value="'.$categories[$i]["id"].'"  ;>'.$categories[$i]["Category"].'</p>
                </div>';

                $item1 = "id_category";
                $value1 = $categories[$i]["id"];
                $order1 = "id";
                $services1 = controllerServices::ctrShowServicesFromRegi($item1, $value1, $order1);
                foreach ($services1 as $key => $value) { 
                    echo '<div class="l-wrapper_06">
                    <div class="card_06" style="border: 3px solid '.$colors[$i].'">
                      <button class="card-content_06 addServiceSale recoverButton" idService="'.$value["id"].'" >'.$value["description"].'</button>
                    </div>
                  </div>'; 
                }
                echo '</div>' ;
              }         
                }
                
          ?>
          </div>

          <!-- 理容 -->
          <input id="TAB-02" type="radio" name="TAB" class="tab-switch" /><label class="tab-label" for="TAB-02">理容</label>
          <div class="tab-content">
          <?php
            $colors = array("#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900");

            $item = null;
            $value = null;
            $categories = controllerCategories::ctrShowCategories($item, $value);
              // var_dump($categories[0]["Category"]);
              for($i=0; $i<count($categories); $i++){
                if(13 <= $categories[$i]["id"] && $categories[$i]["id"] <= 16 ||
                    26 <= $categories[$i]["id"] && $categories[$i]["id"] <= 27){
                  echo '<div class="product" >
                  <div class="l-wrapper_02 card-radius_02" style="background-color: '.$colors[$i].'">
                  <p class="card__title_02" value="'.$categories[$i]["id"].'"  ;>'.$categories[$i]["Category"].'</p>
                </div>';

                $item1 = "id_category";
                $value1 = $categories[$i]["id"];
                $order1 = "id";
                $services1 = controllerServices::ctrShowServicesFromRegi($item1, $value1, $order1);
                foreach ($services1 as $key => $value) { 
                    echo '<div class="l-wrapper_06">
                    <div class="card_06" style="border: 3px solid '.$colors[$i].'">
                      <button class="card-content_06 addServiceSale recoverButton" idService="'.$value["id"].'">'.$value["description"].'</button>
                    </div>
                  </div>'; 
                }
                echo '</div>' ;
              }         
                }
                
          ?>
          </div>
          
          <!-- 商品 -->
          <input id="TAB-03" type="radio" name="TAB" class="tab-switch" /><label class="tab-label" for="TAB-03">商品</label>
          <!-- <div class="box ">
            <div class="box-header with-boader"></div> -->
            <div class="tab-content">
            <?php
            $colors = array("#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900","#ffccff","#ffcc33","yellow","aqua","#ff99ff","#ff9900");

            $item = null;
            $value = null;
            $categories = controllerCategories::ctrShowCategories($item, $value);
              // var_dump($categories[0]["Category"]);
              for($i=0; $i<count($categories); $i++){
                if(28 <= $categories[$i]["id"] && $categories[$i]["id"] <= 35){
                  echo '<div class="product" >
                  <div class="l-wrapper_02 card-radius_02" style="background-color: '.$colors[$i].'">
                  <p class="card__title_02" value="'.$categories[$i]["id"].'"  ;>'.$categories[$i]["Category"].'</p>
                </div>';

                $item1 = "id_category";
                $value1 = $categories[$i]["id"];
                $order1 = "id";
                $products = controllerProducts::ctrShowProductsFromRegi($item1, $value1, $order1);
                foreach ($products as $key => $value) { 
                    echo '<div class="l-wrapper_06">
                    <div class="card_06" style="border: 3px solid '.$colors[$i].'">
                      <button class="card-content_06 addProductSale recoverButton" idProduct="'.$value["id"].'" >'.$value["description"].'</button>
                    </div>
                  </div>'; 
                }
                echo '</div>' ;
              }         
                }
                
          ?>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>



<!-- Module Add Customer -->
<div id="modalAddCustomer" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST">
        <!-- Modal header -->
        <div class="modal-header" style="background:#3c8dbc; color:#fff">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">お客様を追加</h4>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Name input -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control input-lg" type="text" name="newCustomer" placeholder="名前" required>
              </div>
            </div>
            <!-- Email input -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input class="form-control input-lg" type="text" name="newEmail" placeholder="メールアドレス">
              </div>
            </div>
            <!-- Phone input -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="text" name="newPhone" placeholder="電話番号" required>
              </div>
            </div>
            <!-- Address input -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control input-lg" type="text" name="newAddress" placeholder="住所" required>
              </div>
            </div>
            
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">閉じる</button>
          <button type="submit" class="btn btn-primary">保存</button>
        </div>
      </form>

      <?php
        $createCustomer = new ControllerCustomers();
        $createCustomer -> ctrCreateCustomers();
      ?>

    </div>
  </div>
</div>

<!-- Module Add Sales -->
<div id="addSales" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" class="saleForm">
        <!-- Modal header -->
        <div class="modal-header" style="background:#3c8dbc; color:#fff">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">お支払い</h4>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="box-body">
            <!-- saleTotal input -->
            <div class="form-group">
              <div class="input-group aaa">
                <label id="jpy"><span id="morau_saleTotal_value"></span>円</label>
                <input class="form-control input-lg morau_saleTotal" style="border:none" type="hidden" id="morau_saleTotal" name="saleTotal" required>
              </div>
            </div>
            <!-- newSeller input -->
            <div class="form-group modal_pay">
              <div class="input-group">
                <input class="form-control input-lg" type="hidden" id="morau_newSeller" name="newSeller" required>
              </div>
            </div>
            <!-- selectCustomer input -->
            <div class="form-group modal_pay">
              <div class="input-group">
                <input class="form-control input-lg" type="hidden" id="morau_selectCustomer" name="selectCustomer" required>
              </div>
            </div>
            <!-- newSale input -->
            <div class="form-group modal_pay">
              <div class="input-group">
                <input class="form-control input-lg" type="hidden" id="morau_newSale" name="newSale" required>
              </div>
            </div>
            <!-- productsList input -->
            <div class="form-group modal_pay">
              <div class="input-group">
                <input class="form-control input-lg" type="hidden" id="morau_productsList" name="productsList" required>
              </div>
            </div>
            <!-- newTaxPrice input -->
            <div class="form-group modal_pay">
              <div class="input-group">
                <input class="form-control input-lg" type="hidden" id="morau_newTaxPrice" name="newTaxPrice" required>
              </div>
            </div>
            <!-- newNetPrice input -->
            <div class="form-group modal_pay">
              <div class="input-group">
                <input class="form-control input-lg" type="hidden" id="morau_newNetPrice" name="newNetPrice" required>
              </div>
            </div>
            <!-- listPaymentMethod input -->
            <div class="form-group modal_pay">
              <div class="input-group">
                <input class="form-control input-lg" type="hidden" id="morau_listPaymentMethod" name="listPaymentMethod" required>
              </div>
            </div>
            <!-- Payment method -->
            <div class="form-group row">
              <div class="col-xs-6">
                <div class="input-group">
                  <select class="form-control input-lg" name="newPaymentMethod" id="newPaymentMethod" required>
                    <option value="">支払い方法</option>
                    <option value="cash">現金</option>
                    <option value="CC">クレジッドカード</option>
                    <option value="DC">デビットカード</option>
                  </select>
                </div>
              </div>
              <div class="paymentMethodBoxes"></div>
              <input type="hidden" name="listPaymentMethod" id="listPaymentMethod" required>
            </div>
            <!-- listPaymentMethod input -->
            <div class="form-group modal_pay">
              <div class="input-group">
                <input class="form-control input-lg" type="hidden" id="newCashChange" name="newCashChange" required>
              </div>
            </div>
            
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">閉じる</button>
          <!-- <button type="submit" class="btn btn-primary">会計をする</button> -->
        </div>
      </form>

      <?php
        $saveSale = new ControllerSales();
        $saveSale -> ctrCreateSale();
      ?>

    </div>
  </div>
</div>

