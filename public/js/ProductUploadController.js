//Il controller che serve per mostrare i prodotti per la prima pagina
//

function productUploadController($rootScope,$scope,$http){
	//var scope = $rootScope;
	//scope.product = {name:"",price:"",discount:"",totalPrice:"",rating:"",img:""}
	scope = $rootScope;
	scope.product={stock:1,price:0,discount:0};
	scope.list=[];
	scope.imgList=[];
	scope.process=1;


    //$scope.list=[];
    //var adminusername = window.localStorage.getItem("adminUser");
    //$scope.user ={grant_type:"password",client_id:2,client_secret:"DJkHupOD3eEbdiCpurw9Kwfw6RsZByVf9FMQePjB",
    //username:adminusername,password:"secret"};

    /*$scope.getAuth = function(){
    	$http.post("http://localhost:8000/oauth/token",$scope.user)
    	.success(function(response){
    		console.log(response);
    		console.log(response.access_token);


    		$scope.user.token=response.access_token;
    		window.localStorage.setItem("token2", response.access_token);
    		console.log(window.localStorage.getItem("token2"));
    		alert("Ti sei loggato!");




    	})
    	.error(function(response){
    		console.log(response);
    		alert("Accesso negato!");
    	});
    }();*/

    scope.uploadProduct = function(){
      var token = 'Bearer '+window.localStorage.getItem("token2");
      console.log(token);
      $http.post('/api/products',$scope.product,{

                        
                        headers: {
                                  'Accept' : 'application/json',
                                  'Authorization': token
                                   //transformRequest: angular.identity

                                   // $scope.user.token


                                    }
                })
                
                    .success(function(response) {
                        
                    alert("Prodotto aggiunto correttamente!");
                    scope.product = response.data;
                    scope.img='';
                    console.log(response);
                    scope.process=2;
                        

                    })
                    .error(function(response) {
                        alert("Si è verificato un errore!");
                        console.log(response);
                    });
    };


    scope.uploadProductDetail = function(){

    	var token = 'Bearer '+window.localStorage.getItem("token2");
    	$http.post(scope.product.href.details , $scope.product.details,{

                        
                        headers: {
                                  'Accept' : 'application/json',
                                  'Authorization': token
                                   //transformRequest: angular.identity

                                   // $scope.user.token


                                    }
                })
                
                    .success(function(response) {
                        
                    alert("Dettagli prodotto aggiunto correttamente!");
                    /*scope.product.details.category = response.data.category;
                    scope.product.details.brand = response.data.brand;
                    scope.product.details.man = response.data.man;
                    scope.product.details.color = response.data.color;*/
                    console.log(response);
                    scope.process=3;

                    })
                    .error(function(response) {
                        alert("Si è verificato un errore!");
                        console.log(response);
                    });



    };
//Fare in modo che la get dei prodotti restituisca anche i href alle taglie
    scope.uploadTails = function(){
    	var token = 'Bearer '+window.localStorage.getItem("token2");
    	//Implementare 
    	$http.post('/api/products/'+scope.product.id+'/tails' , $scope.product.tails,{

                        
                        headers: {
                                  'Accept' : 'application/json',
                                  'Authorization': token
                                   //transformRequest: angular.identity

                                   // $scope.user.token


                                    }
                })
                
                    .success(function(response) {
                        
                    alert("Taglie prodotto aggiunto correttamente!");
                    
                    
                    console.log(response);
                        

                    })
                    .error(function(response) {
                        alert("Si è verificato un errore!");
                        console.log(response);
                    });

    };



    scope.uploadFile = function(files){
    var token = 'Bearer '+window.localStorage.getItem("token2");
    var fd = new FormData();
    scope.list.push(files[0].name);
    console.log(scope.list[scope.list.length-1]);

    fd.append("file",files[0]);
    $http.post("http://localhost:8000/api/products/"+scope.product.id +"/uploadFile",fd, {
      //withCredentials: true,
      headers: {'Content-type' : undefined,
                'Authorization': token
    },
     transformRequest: angular.identity})
    .then(function successCallback(response){
      console.log(response);
      console.log(scope.product.img);
      //$scope.product.img = response.data;

      if(scope.product.img==null){
      	scope.product.img = response.data;
      	console.log(response.data);
      	console.log(scope.product.img);
      }else{
      	scope.imgList.push(response.data);
      	console.log(scope.imgList);
      }
    },function errorCallback(response){
      console.log(response);
      alert(response);
    });
    
  };

};