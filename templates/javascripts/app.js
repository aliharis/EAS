
var HOST = "http://localhost/EAS/";

/**
 * Login Form Alignment
 */

		function getWindowHeight() {
			var windowHeight = 0;
			if (typeof(window.innerHeight) == 'number') {
				windowHeight = window.innerHeight;
			}
			else {
				if (document.documentElement && document.documentElement.clientHeight) {
					windowHeight = document.documentElement.clientHeight;
				}
				else {
					if (document.body && document.body.clientHeight) {
						windowHeight = document.body.clientHeight;
					}
				}
			}
			return windowHeight;
		}
		function setContent() {
			if (document.getElementById) {
				var windowHeight = getWindowHeight();
				if (windowHeight > 0) {
					var contentElement = document.getElementById('login_box');
					var contentHeight = contentElement.offsetHeight;
					if (windowHeight - contentHeight > 0) {
						contentElement.style.position = 'relative';
						contentElement.style.top = ((windowHeight / 2) - (contentHeight / 2)) + 'px';
					}
					else {
						contentElement.style.position = 'static';
					}
				}
			}
		}
		window.onload = function() {
			setContent();
		}
		window.onresize = function() {
			setContent();
		}

$(document).ready(function(){ 
	// function to close error message
	$(".close_msg").click(function() {
	  $(this).parent().fadeOut();
	  location.href=location.href.replace(/&?msg=([^&]$|[^&]*)/i, "");
	});

 }); 

$(function(){
var $form = $('#my-form'),
    $summands = $form.find('.foo'),
    $sumDisplay = $('#money-out');

$form.delegate('.foo', 'change', function ()
{
    var sum = 0;
    $summands.each(function ()
    {
        var value = Number($(this).val());
        if (!isNaN(value)) sum += value;
    });

    $(".foototal").val(sum);
});
});//]]>  

/** CAT B */
$(function(){
var $form = $('#cat-b-form'),
    $summands = $form.find('.cat-b-select'),
    $sumDisplay = $('#money-out');

$form.delegate('.cat-b-select', 'change', function ()
{
    var sum = 0;
    $summands.each(function ()
    {
        var value = Number($(this).val());
        if (!isNaN(value)) sum += value;
    });

    $(".cat-b-total").val(sum);

    // calculate the percentage
    var percentage = $(".cat-b-total").val() * ($(".cat-b-percentage-allocated").val() / 100);
    // display the percentage and set 1 decimal point
    $(".cat-b-percentage").val(percentage.toFixed(1));
});
});//]]> 

/** CAT C */
$(function(){
var $form = $('#cat-c-form'),
    $summands = $form.find('.cat-c-select');

$form.delegate('.cat-c-select', 'change', function ()
{
    var sum = 0;
    $summands.each(function ()
    {
        var value = Number($(this).val());
        if (!isNaN(value)) sum += value;
    });

    $(".cat-c-total").val(sum);

    // calculate the percentage
    var percentage = $(".cat-c-total").val() * ($(".cat-c-percentage-allocated").val() / 100);
    // display the percentage and set 1 decimal point
    $(".cat-c-percentage").val(percentage.toFixed(1));
});
});//]]> 

/** CAT D */
$(function(){
var $form = $('#cat-d-form'),
    $summands = $form.find('.cat-d-select');

$form.delegate('.cat-d-select', 'change', function ()
{
    var sum = 0;
    $summands.each(function ()
    {
        var value = Number($(this).val());
        if (!isNaN(value)) sum += value;
    });

    $(".cat-d-total").val(sum);

    // calculate the percentage
    var percentage = $(".cat-d-total").val() * ($(".cat-d-percentage-allocated").val() / 100);
    // display the percentage and set 1 decimal point
    $(".cat-d-percentage").val(percentage.toFixed(1));
});
});//]]> 

/** CAT E */
$(function(){
var $form = $('#cat-e-form'),
    $summands = $form.find('.cat-e-select');

$form.delegate('.cat-e-select', 'change', function ()
{
    var sum = 0;
    $summands.each(function ()
    {
        var value = Number($(this).val());
        if (!isNaN(value)) sum += value;
    });

    $(".cat-e-total").val(sum);

    // calculate the percentage
    var percentage = $(".cat-e-total").val() * ($(".cat-e-percentage-allocated").val() / 100);
    // display the percentage and set 1 decimal point
    $(".cat-e-percentage").val(percentage.toFixed(1));
});
});//]]> 

function addColumn(table) {
	var table;

	if (table = "department") {
		$('.list_view tr:last').after('<tr><td><input type="text" name="name" id="insertname" /> <a href="#" onclick="insert(\'department\'); return false;" class="button radius5">Save</a></td></tr>');
	}	
}

function insert(table) {
	var table;
	var value = $("#insertname").val();

 	$.ajax({
 		type: 'POST',
 		url: HOST + 'index.php?act=insert',
 		data: { table: table, value: value }
 	}).done(function(msg) {
 		console.log(msg);
 		window.location.reload();
 	});	
}

function update(table) {
	var table;
	var value = $("#updatename").val();
	var id = $("#updateid").val();

 	$.ajax({
 		type: 'POST',
 		url: HOST + 'index.php?act=update',
 		data: { table: table, value: value, id: id }
 	}).done(function(msg) {
 		console.log(msg);
 		window.location.reload();
 	});	
}

function edit(id, name, table) {
	var table;
	console.log(id, name, table);

	if (table == "department") {
		$("#edit-"+id).empty();
		$("#edit-"+id).append('<input type="hidden" name="name" id="updateid" value="'+id+'" /> <input type="text" name="name" id="updatename" value="'+name+'" /> <a href="#" onclick="update(\'department\'); return false;" class="button radius5">Update</a>');
	} else if (table == "subcategories") {
		$("#edit-"+id).empty();
		$("#edit-"+id).append('<input type="hidden" name="name" id="updateid" value="'+id+'" /> <input type="text" name="name" id="updatename" value="'+name+'" /> <a href="#" onclick="update(\'subcategories\'); return false;" class="button radius5">Update</a>');
	}
}

function addSubCategory(id) {
	var id;

	console.log("Hello " + id);

	if (id == "CAT A") {
		$("#CAT_A").append('<tr><td><input type="hidden" name="name" id="catid" value="'+id+'" /> <input type="text" name="name" id="description" required="required" /> <a href="#" onclick="addSubCat(); return false;" class="button radius5">Add</a></td></tr>');
	} else if (id == "CAT B") {
		$("#CAT_B").append('<tr><td><input type="hidden" name="name" id="catid" value="'+id+'" /> <input type="text" name="name" id="description" required="required" /> <a href="#" onclick="addSubCat(); return false;" class="button radius5">Add</a></td></tr>');
	} else if (id == "CAT C") {
		$("#CAT_C").append('<tr><td><input type="hidden" name="name" id="catid" value="'+id+'" /> <input type="text" name="name" id="description" required="required" /> <a href="#" onclick="addSubCat(); return false;" class="button radius5">Add</a></td></tr>');
	} else if (id == "CAT D") {
		$("#CAT_D").append('<tr><td><input type="hidden" name="name" id="catid" value="'+id+'" /> <input type="text" name="name" id="description" required="required" /> <a href="#" onclick="addSubCat(); return false;" class="button radius5">Add</a></td></tr>');
	} else if (id == "CAT E") {
		$("#CAT_E").append('<tr><td><input type="hidden" name="name" id="catid" value="'+id+'" /> <input type="text" name="name" id="description" required="required" /> <a href="#" onclick="addSubCat(); return false;" class="button radius5">Add</a></td></tr>');
	}
}

function addSubCat() {
	var catid = $("#catid").val();
	var description = $("#description").val();

	$.ajax({
 		type: 'POST',
 		url: HOST + 'index.php?act=add_subcategory',
 		data: { catid: catid, description: description }
 	}).done(function(msg) {
 		console.log(msg);
 		window.location.reload();
 	});	
}

