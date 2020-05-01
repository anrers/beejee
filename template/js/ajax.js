$( document ).ready(function() {
    
    $("#btn").click(
		function(){
			sendAjaxForm('result_form', 'ajax_form', 'ajax');
			return false; 
		}
	);

    $("#btn_add").click(
		function(){
			$('#add_form').css('display', '');
		}
	);
});
 
function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
                result = $.parseJSON(response);
                if (result.status === 'ok') {
                   
                    $('#result_form').html('Задача успешно добавлена');
                } 
                else {
                    let str = ''; //вывод ошибок
                    $.each(result, function(key, value) { 
                        res = value+'<br>'
                        str = str + res;
                    });
                     $('#' + result_form).html(str);
                }
        	
    	},
    	error: function(response) { // Данные не отправлены
            $('#'+result_form).html('Ошибка. Данные не отправлены.');
    	}
 	});
}
