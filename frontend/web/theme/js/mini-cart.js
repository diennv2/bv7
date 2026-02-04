define(['jquery','underscore','bootstrapCss','bizwebAPI'],function($,_){



	function _load(isOpen = false) {
		$.ajax({
			url: '/cart.js'+'?_='+Math.random()*100000,
			type:'GET',
			dataType:'json',
			cache: false
		}).done(function (data) {
			//console.log(JSON.stringify(data));
			var $cart = $("#cart-bottom");
			if(data.items && data.items.length > 0)
			{
				var tpl = _.template($("#tpl-cart").html());

				var total = 0;
				var numberItem = 0;
				for(var i = 0; i < data.items.length; i++)
				{
					total = total + parseFloat(data.items[i].quantity)*parseFloat(data.items[i].price);
					numberItem = numberItem+data.items[i].quantity;
				}
				$cart.html(tpl({items:data.items.reverse(),total: total,numberItem:numberItem}));
				$cart.removeAttr('style');
				$cart.show();
				if($(".ega-a-cart-icon-top__number").length > 0)
				{
					$(".ega-a-cart-icon-top__number").text(numberItem);
				}
				//hide 5+ items
				$("ul.ega-ul-mini-cart > li:gt(3)").hide();
				if($(window).width()<=768)
				{
					$("ul.ega-ul-mini-cart > li:gt(1)").hide();
				}
				$("body").css('margin-bottom','60px');
				//bind click
				//$(document).on("click","a.ega-mini-cart-more",function () {
				$('a.ega-mini-cart-more').click(function () {
					$("#mini-cart-detail").show();
					$("#mini-cart-less-info").hide();
				});
				if(isOpen) {
					$("a.ega-mini-cart-more").click();
				}
				$('a.ega-mini-cart-less').click(function () {
					$("#mini-cart-detail").hide();
					$("#mini-cart-less-info").show();
				});
				$("a.ega-e-remove-cart-item").click(function () {
					var id = $(this).data('id');
					$(this).text("Đang xóa");
					_changeItem(id,0);
				});
				$('.ega-min-cart-plus').click(function (e) {
					e.stopPropagation();
					e.preventDefault();
					e.stopImmediatePropagation();
					var $input = $(this).prev();
					var qty = $input.val();
					qty++;
					$input.val(qty);
					var id =  $(this).data('id');
					$(this).text("Đang cập nhật");
					_changeItem(id,qty);
				});
				$('.ega-min-cart-minus').click(function (e) {
					e.stopPropagation();
					e.preventDefault();
					e.stopImmediatePropagation();
					var $input = $(this).next();
					var qty = $input.val();
					qty--;
					$input.val(qty);
					var id =  $(this).data('id');
					$(this).text("Đang cập nhật");
					_changeItem(id,qty);
				});
			}
			else{
				$cart.hide();
				$("body").css('margin-bottom',0);
				if($(".ega-a-cart-icon-top__number").length > 0)
				{
					$(".ega-a-cart-icon-top__number").text('0');
				}
			}
		}).fail(function (err) {
			console.log(JSON.stringify(err));
		});
	}

	function _changeItem(id,qty) {
		$.ajax({
			type: "POST",
			url: "/cart/change.js",
			data: "quantity="+qty+"&id=" + id,
			dataType: "json"
		}).done(function () {
			_load(true);
		}).fail(function (err) {
			console.log(JSON.stringify(err));
		});
	}

	return{
		popupAddCart:function (data) {
			$("#mini-cart-popup-success").html("<img style='width: 100px;' src='"+data.image+"' /><div>Thêm "+data.title+" thành công.</div>")
			$("#popup-add-cart-success").modal('show');
			setTimeout(function () {
				$("#popup-add-cart-success").modal('hide');
				_load();
			},2000);
		},
		fetch: function () {
			_load();
		}
	}
});