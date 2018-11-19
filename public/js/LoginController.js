function loginController($rootScope,$scope,$http,$window){
	//var scope = $rootScope;
	//$scope.product={stock:1,description:"Good!"};
    //$scope.list=[];
    $scope.user ={grant_type:"password",client_id:2,client_secret:"DJkHupOD3eEbdiCpurw9Kwfw6RsZByVf9FMQePjB"};

    $scope.getAuth = function(){
    	$http.post("/oauth/token",$scope.user)
    	.success(function(response){
    		console.log(response);
    		console.log(response.access_token);
    		$scope.user.token=response.access_token;
    		window.localStorage.setItem("token2", response.access_token);
    		console.log(window.localStorage.getItem("token2"));
    		alert("Ti sei loggato!");

    		window.localStorage.setItem("adminUser",$scope.user.username);
    	})
    	.error(function(response){
    		console.log(response);
    		alert("Accesso negato!");
    	});
    };

    $scope.isAdmin = function(){
    	var req = {
      method: 'GET',
      url: '/api/products?page='+page,

      headers: { 'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': 'Bearer '+window.localStorage.getItem("token2")
    }

  };
  //Con la prima chiamata http mi prendo i prodotti in prima pagina
    $http(req)
    .success(function(response){
      $rootScope.isAdmin = true;
      alert("E' admin!");
     
    })
    .error(function(response){
      alert("errore");
    });
    }

};