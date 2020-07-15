<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Онлйн Оплата</title>
 <!--<style type="text/css">
  .pay-button{
    background: #ffc423 none repeat scroll 0 0;
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.5);
    color: #1f2124;
    font-family: "Azoftsans-bold",Arial,sans-serif;
    font-size: 17px;
    line-height: 27px;
    padding: 10px;
    position: relative;
    text-transform: uppercase;
    z-index: 1;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    height: 47px;
    cursor: pointer;
    margin-top: 20px;
    display: inline-block;

  text-align: center;
}
  </style>-->
<!-- Подключение библиотеки jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Подключение jQuery плагина Masked Input -->
<script src="script/jquery.maskedinput.min.js"></script>
 </head>
 <body>
  <?php
$file = __DIR__ . '/counter.txt';
        if (file_exists($file)) {
            $counter = file_get_contents($file);
        } else {
            $counter = 0;
        }
        $counter++;
        //echo $counter;
        file_put_contents($file, $counter);

?>
     
     <div class="container">
                      <h3>Оформление заказа</h3>
     </div>
     <form id="zvk" action="https://powerbank.rumarket.store/yapay/payOnline.php" method="POST" name="act1" onsubmit="return checkForm()">
                                  <div class="info">
                                      <label>Имя</label>
                                      <input required id="post" type="text" value="" name="name">
                                  </div>
                                  <div class="info">
                                      <label>Телефон</label>
                                      <input required id="phone" type="text" value="" name="phone">
                                  </div>
                                  <div class="info">
                                      <label>Индекс</label>
                                      <input id="post" type="text" value="" name="zip">
                                  </div>
                                  <div class="info">
                                      <label>Адрес</label>
                                      <textarea required id="post" type="text" value="" name="adress"></textarea>
                                  </div>
                                  <div id="mydiv" style="display:block;">
                                            <div id="mydiv-block">
                                            <input type="radio" name="ves" id="ves1" value="Выбран Комплект 1" class="test"
                                            onchange="addIt(499)" checked>
                                            <label for="ves1"> 1 Комплект</label>
                                            </div>
                                            
                                            <div id="mydiv-block">
                                            <input type="radio" name="ves" id="ves2" value="Выбран Комплект 2" class="test"
                                            onchange="addIt(998)">
                                            <label for="ves2"> 2 Комплекта</label>
                                            </div>
                                            </div>
                                           <div id="maineu-dost">
                                          Стоимость <input type="text" id="amount" value="499" name="amount" readonly> руб.
                                          <input type="hidden" value="<?php echo $counter; ?>" name="id-order">
                                  </div>
                                  <button id="fullpaid" class="pay-button send">
                                    Заказать
                                  </button>
      </form>
<script type="text/javascript">
<!--
function addIt(value) { 
document.getElementById("amount").value = value;
}
// -->
</script>
<script>
//Код jQuery, установливающий маску для ввода телефона элементу input
//1. После загрузки страницы,  когда все элементы будут доступны выполнить...
$(function(){
  //2. Получить элемент, к которому необходимо добавить маску
  $("#phone").mask("+7 (999) 999-99-99");
});
</script>
 </body>
</html>