define(['jquery','underscore','bizwebAPI'],function($,_){

	function _render()
	{
		if(localStorage.getItem("savedProduct"))
		{
			var arrProduct = JSON.parse(localStorage.getItem("savedProduct"));
			if(arrProduct.length > 0)
			{
				//console.log(JSON.stringify(arrProduct));
				var tpl = _.template($("#tpl-saved-product").html());
				$("#saved-product-bottom").html(tpl({items:arrProduct}));
				$("#saved-product-bottom").show();
			}

		}
		else{

		}
	}

	return{
		save:function (product) {
			var savingProduct = {
				id: product.id,
				name:product.title,
				alias:product.handle,
				price:product.price,
				compare_at_price_max:product.compare_at_price_max,
				img: product.featured_image ? product.featured_image : ''
			};
			var arrProduct =  [];
			if(localStorage.getItem("savedProduct"))
			{
				arrProduct = JSON.parse(localStorage.getItem("savedProduct"));
			}
			var isHasInArr = false;
			for(var i = 0; i < arrProduct.length;i++)
			{
				if(arrProduct[i].id == savingProduct.id)
				{
					isHasInArr = true;
					break;
				}
			}
			if(!isHasInArr)
			{
				arrProduct.unshift(savingProduct);
			}
			arrProduct = _.first(arrProduct, 4);
			// Safari, in Private Browsing Mode, looks like it supports localStorage but all calls to setItem
			// throw QuotaExceededError. We're going to detect this and just silently drop any calls to setItem
			// to avoid the entire page breaking, without having to do a check at each usage of Storage.
			if (typeof localStorage === 'object') {
				try {
					localStorage.setItem("savedProduct", JSON.stringify(arrProduct));
				} catch (e) {
					Storage.prototype._setItem = Storage.prototype.setItem;
					Storage.prototype.setItem = function() {};
				}
			}
			//localStorage.setItem("savedProduct", JSON.stringify(arrProduct));
			_render();
		},
		render: function () {
			_render();
		}
	}
});