//Il controller che serve per mostrare i prodotti per la prima pagina
//
function productsAreaController($rootScope,$scope,$http,ProductService){
	var scope = $rootScope;
	scope.product = {name:"",price:"",discount:"",totalPrice:"",rating:"",link:""}
	scope.list=[];
	scope.page={last:0}

                    

	$http.get('http://localhost:8000/api/products')
	.success(function(response){
		console.log(response);
		data = response.data;
		scope.page.last = response.meta.last_page;
		for(let i=0;i<response.data.length;i++){
			ProductService.addProduct(response.data[i]);
			//scope.list[0].append(response.data[i])
		}
		//scope.list[0] = ProductService.getProducts();
	})
	.error(function(response){
		console.log(response);
		alert("qualcosa è andato storto!");
	})

	$http.get('http://localhost:8000/api/products?page=2')
	.success(function(response){
		console.log(response);
		data = response.data;
		for(let i=0;i<response.data.length;i++){
			//scope.list[1].append(response.data[i]);
			ProductService.addProduct(response.data[i]);
		}
		//scope.list[1] = ProductService.getProducts();
	})
	.error(function(response){
		console.log(response);
		alert("qualcosa è andato storto!");
	})

	scope.list = ProductService.getProducts();

	scope.getFirst=function(n){
		return n=0 ? "active": "";
	}

};