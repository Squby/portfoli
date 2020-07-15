<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/video.css?v1.0.1">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <title>Специальное предложение</title>
</head>
<body>
<?php

$number = $_POST['number'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$messages = $_POST['messages'];
$oldman = $_POST['oldman'];
$yangman = $_POST['yangman'];
$veryangman = $_POST['veryangman'];
$area = $_POST['area'];
$numberRoom = $_POST['numberRoom'];
$date = $_POST['date'];
?>

<div class="container">
    <form action="payOnline.php" class="special-form" method="post">
        <label class="data-title">Давайте проверим ваш заказ: №<span><?= $number; ?></span></label>
        <input type="text" hidden class="data-name data-input" name="number" value="<?= $number ?>">
        <p class="data-subtitle">выберите варианты размещения</p>
        <select id="bungaloCont" name="bungalo" class="data-input data-housing" required>
            <option value="Комната с вентилятором" selected>Комната с вентилятором</option>
            <option value="Маленькое бунгало с кондиционером">Маленькое бунгало с кондиционером</option>
            <option value="Большое бунгало с кондиционером">Большое бунгало с кондиционером</option>
        </select>
        <div class="data-price">
            <p class="age">Взрослый: <span id="adult_price">1700</span> бат/чел</p>
            <p class="age">Детский: <span id="child_price">1500</span> бат/чел</p>
        </div>
        <p class="data-subtitle">Проверьте данные (имя и телефон)</p>
        <input type="text" id="name" class="data-name data-input minedata" name="name" placeholder="Имя" value="<?= $name ?>" required>
        <input type="phone" id="phone" class="data-phone data-input minedata" name="phone" placeholder="Номер телефона" value="<?= $phone ?>" required>
        <select id="messCont" name="messeges" class="data-input minedata" required>
            <option value="Не выбран" selected>Выберите мессенджер</option>
            <option value="WhatsApp">WhatsApp</option>
            <option value="Telegram">Telegram</option>
            <option value="Viber">Viber</option>
        </select>
        <p class="data-subtitle">Колличество билетов</p>
        <select id="adultCont" name="oldman" class="data-input" required>
            <option value="0" selected>Количество взрослых</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
        <select id="childCont" name="yangman" class="data-input" >
            <option value="0" selected>Количество детей (от 4-х до 10 лет)</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
        <select id="infantCont" name="veryangman" class="data-input" >
            <option selected>Количество младенцев ( до 4-х лет)</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>
        <p class="data-subtitle">Название отеля и номер/комната</p>
        <input id="area" type="text" class="data-input" name="area" placeholder="Название отеля/района/улицы" value="<?= $area ?>" required>
        <input id="room" type="text" class="data-input" name="numberRoom" placeholder="Номер комнаты/дома" value="<?= $numberRoom ?>" required>
        <p class="data-subtitle">дата тура</p>
        <input id="date" type="date" class="data-input" name="calendar" placeholder="Выберете дату" value="<?= $date ?>" required>
        <p class="data-subtitle">Допонительные опции</p>
        <div class="data-addotion">
        <div class="data-addotion1"><label><input id="one_person" type="checkbox">Доплата за 1-местное размещение</label><span><span id="one_person_price"> - 600</span> бат</span></div>
        <div class="data-addotion2"><label><input id="more_place" type="checkbox">Дополнительное место</label><span> - бесплатно</span></div>
        <div class="data-addotion3"><label><input id="more_night" type="checkbox">Дополнительная ночь</label><span><span id="more_night_price"> - 1200</span> бат</span></div>
        </div>
    
       <div class="wrapper-total">
            <p class="total">Итоговая цена: <b id="price">0</b> бат</p>
        <p class="total">Итоговая цена в рублях: <b id="priceRub">0</b> руб</p>
       </div>    
        <input id="finalPrice" type="text" hidden class="data-name data-input" name="value">
        <button id="done_btn" type="submit" class="data-button button">оплатить</button>
    </form>
</div>
<script>

    var thb_rub = 0;
    var final_price = 0;
    var adult_price = 1700;
    var child_price = 1500;
    var one_person_price = 600;
    var more_night_price = 1200;

    var bungalo_select = document.getElementById('bungaloCont');
    var adult_select = document.getElementById('adultCont');
    var child_select = document.getElementById('childCont');
    var one_person_chk = document.getElementById('one_person');
    var more_place_chk = document.getElementById('more_place');
    var more_night_chk = document.getElementById('more_night');
    var done_btn = document.getElementById('done_btn');

    bungalo_select.addEventListener('change', function () {

        if(bungaloCont.options[0].selected == true)
        {
            adult_price = 1700;
            child_price = 1500;
            one_person_price = 600;
            more_night_price = 1200;
        }

        if(bungaloCont.options[1].selected == true)
        {
            adult_price = 1900;
            child_price = 1700;
            one_person_price = 800;
            more_night_price = 1600;
        }

        if(bungaloCont.options[2].selected == true)
        {
            adult_price = 2000;
            child_price = 1800;
            one_person_price = 900;
            more_night_price = 1800;
        }

        document.getElementById('adult_price').innerHTML = adult_price;
        document.getElementById('child_price').innerHTML = child_price;
        document.getElementById('one_person_price').innerHTML = one_person_price;
        document.getElementById('more_night_price').innerHTML = more_night_price;

        calculate();

    }, false);
    adult_select.addEventListener('change', function () {

        if(adult_select.value == 1 && child_select.value == 0)
            one_person_chk.checked = true;
        else
            one_person_chk.checked = false;

        calculate();

    }, false);
    child_select.addEventListener('change', function () {

        if(adult_select.value == 1 && child_select.value == 0)
            one_person_chk.checked = true;
        else
            one_person_chk.checked = false;

        calculate();

    }, false);
    one_person_chk.addEventListener('change', function () {

        calculate();

    }, false);
    more_night_chk.addEventListener('change', function () {

        calculate();

    }, false);
    done_btn.addEventListener('click', function () {

        $.ajax(
        {
            url: "script/mail_simple.php",
            type: 'POST',
            data:
                {
                    counter: "<?= $number; ?>",
                    bungalo: bungalo_select.value,
                    name: document.getElementById('name').value,
                    phone: document.getElementById('phone').value,
                    messeges: document.getElementById('messCont').value,
                    oldman: adult_select.value,
                    yangman: child_select.value,
                    veryangman: document.getElementById('infantCont').value,
                    area: document.getElementById('area').value,
                    numberRoom: document.getElementById('room').value,
                    calendar: document.getElementById('date').value
                },
            dataType: "html",
            success: function (response) {

            }
        });


    }, false);

    function calculate()
    {
        final_price = (adult_select.value * adult_price) + (child_select.value * child_price) + (one_person_chk.checked == true ? one_person_price : 0) + (more_night_chk.checked == true ? more_night_price : 0);
        document.getElementById('price').innerHTML = final_price;

        document.getElementById('priceRub').innerHTML = (final_price * thb_rub).toFixed(2);
        document.getElementById('finalPrice').value = (final_price * thb_rub).toFixed(2);
    }

    function get_thb()
    {
        $.ajax(
        {
            url: "script/curse.php",
            type: 'GET',
            dataType: "xml",
            success: function (xml)
            {
                var rub = 0;
                var thb = 0;

                jQuery(xml).find('Cube').each(
                function()
                {
                    var cur = jQuery(this).attr('currency'),
                        val = jQuery(this).attr('rate');

                    if(cur == "RUB")
                        rub = val;

                    if(cur == "THB")
                        thb = val;
                });

                thb_rub = rub / thb;

                calculate();
            }
        });
    }

    //Мессенджер
    var messCont = document.getElementById('messCont');
    var mess = "<?= $messages; ?>";

    for(var i = 1; i < messCont.length; i++)
    {
        if(messCont.options[i].value == mess)
        {
            messCont.options[i].selected = true;
        }
    }

    //Взрослые
    var adultCont = document.getElementById('adultCont');
    var adult = "<?= $oldman; ?>";

    for(var i = 1; i < adultCont.length; i++)
    {
        if(adultCont.options[i].value == adult)
        {
            adultCont.options[i].selected = true;
        }

        if(adult == 1)
            one_person_chk.checked = true;
    }

    //Дети
    var childCont = document.getElementById('childCont');
    var child = "<?= $yangman; ?>";

    for(var i = 1; i < childCont.length; i++)
    {
        if(childCont.options[i].value == child)
        {
            childCont.options[i].selected = true;
        }
    }

    //Младенцы
    var infantCont = document.getElementById('infantCont');
    var infant = "<?= $veryangman; ?>";

    for(var i = 1; i < infantCont.length; i++)
    {
        if(infantCont.options[i].value == infant)
        {
            infantCont.options[i].selected = true;
        }
    }

    get_thb();

</script>
</body>
</html>