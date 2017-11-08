var app = angular.module("Labo", ['ngMaterial','ui.bootstrap','ngAnimate','ngSanitize','ngRoute','ngResource','ngMdIcons']);

app.config(function($routeProvider) {
    $routeProvider
    .when('/', {
        templateUrl : 'html/menu.html',
        controller  : 'mainController'
    })
    .when('/alumno', {
        templateUrl : 'html/alumno.html',
        controller  : 'mainController'
    })
    .when('/menu', {
        templateUrl : 'html/menu.html',
        controller  : 'mainController'
    })
    .when('/profesor', {
        templateUrl : 'html/profesor.html',
        controller  : 'mainController'
    })
    .when('/equipo', {
        templateUrl : 'html/equipo.html',
        controller  : 'mainController'
    })
    .when('/profesor', {
        templateUrl : 'html/profesor.html',
        controller  : 'mainController'
    })
    .when('/materia', {
        templateUrl : 'html/materia.html',
        controller  : 'mainController'
    })
    .when('/inventario', {
        templateUrl : 'html/inventario.html',
        controller  : 'mainController'
    })
    .when('/prestamos', {
        templateUrl : 'html/prestamos.html',
        controller  : 'mainController'
    })
    .when('/ayuda', {
        templateUrl : 'html/ayuda.html',
        controller  : 'mainController'
    })
    .when('/acerca', {
        templateUrl : 'html/acerca.html',
        controller  : 'mainController'
    });
});

app.controller('mainController', function($scope,$mdDialog,$mdToast,$http,$timeout) {
    //FUNCTIONS FOR TOAST (Notifications)
    var last = {
        bottom: true,
        top: false,
        left: true,
        right: false
    };
    $scope.toastPosition = angular.extend({}, last);
    $scope.getToastPosition = function () {
        sanitizePosition();

        return Object.keys($scope.toastPosition)
            .filter(function (pos) { return $scope.toastPosition[pos]; })
            .join(' ');
    };
    function sanitizePosition() {
        var current = $scope.toastPosition;

        if (current.bottom && last.top) current.top = false;
        if (current.top && last.bottom) current.bottom = false;
        if (current.right && last.left) current.left = false;
        if (current.left && last.right) current.right = false;

        last = angular.extend({}, current);
    }
    //END FUNCTIONS FOR TOAST


    $scope.$materia = {
            dates: {
                id: "",
                name: ""
            }
    };


    $scope.selectMateria = function () {
        $http({
            method: 'get',
            url: 'php/materia/select.php'
        }).then(function (response) {
            $scope.$listMateria = response.data;
            //console.log($scope.$listMateria);
        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };

    $scope.selectMateria();
    //Insert a new Materia
    $scope.submitMateria = function () {
        $http({
            method: 'post',
            url: 'php/materia/insert.php',
            data: {
                name: $scope.$materia.dates.name
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectMateria(); //Update the table
            $scope.$materia.dates.name = "";
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.findMateria = function () {
        $http({
            method: 'post',
            url: 'php/materia/selectByName.php',
            data: {
                name: $scope.$materiaFindName
            }
        }).then(function (response) {
            $scope.$materia.dates.name = response.data[0].nombre;
            $scope.$materia.dates.id = response.data[0].id;
            $scope.$materiaFindName = "";
            console.log(response);
        }, function (error) {
            console.log(error);
        });
    };

    $scope.updateMateria = function () {
        $http({
            method: 'put',
            url: 'php/materia/update.php',
            data: {
                name: $scope.$materia.dates.name,
                id: $scope.$materia.dates.id
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectMateria(); //Update the table
            $scope.$materia.dates.name = "";
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.deleteMateria = function (id,ev) {
        $http({
            method: 'delete',
            url: 'php/materia/delete.php',
            data: {
                id: id
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectMateria(); //Update the table
            $scope.$materia.dates.name = "";
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.goToMateria = function(id, ev){
        $http({
            method: 'post',
            url: 'php/materia/selectById.php',
            data: {
                id: id
            }
        }).then(function (response) {
            $timeout(function () {
                console.log('$timeout was executed');
                $scope.$apply(function () {
                    $scope.$materia.dates.name = response.data[0].nombre;
                    $scope.$materia.dates.id = response.data[0].id;
                });
            }, 0);
            console.log(response);
        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };

    ////////////////////////////////////////////////////////ALUMNO//////////////////////////////////////
    $scope.$Alumno = {
            dates: {
                name: "",
                fln: "",
                sln: "",
                id: 0
            }
    };

    $scope.changeValueMateria = function (val,type) {
        $scope.$Alumno.dates.materia = val;
    };

    $scope.selectAlumno = function () {
        $http({
            method: 'get',
            url: 'php/Alumno/select.php'
        }).then(function (response) {
            $scope.$listAlumno = response.data;
            console.log($scope.$listAlumno);
        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };

    $scope.selectAlumno();
    //Insert a new Alumno

    $scope.submitAlumno = function () {
        $http({
            method: 'post',
            url: 'php/Alumno/insert.php',
            data: {
                nombre: $scope.$Alumno.dates.name,
                apellido1: $scope.$Alumno.dates.fln,
                apellido2: $scope.$Alumno.dates.sln,
                id: $scope.$Alumno.dates.id,
                materia: $scope.$Alumno.dates.materia
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectAlumno(); //Update the table
            $scope.$Alumno.dates.name = "";
            $scope.$Alumno.dates.fln = "";
            $scope.$Alumno.dates.sln = "";
            $scope.$Alumno.dates.id = "";
            $scope.$Materias = "";
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.updateAlumno = function () {
        $http({
            method: 'put',
            url: 'php/Alumno/update.php',
            data: {
                nombre: $scope.$Alumno.dates.name,
                apellido1: $scope.$Alumno.dates.fln,
                apellido2: $scope.$Alumno.dates.sln,
                id: $scope.$Alumno.dates.id,
                materia: $scope.$Alumno.dates.materia
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectAlumno(); //Update the table
            $scope.$Alumno.dates.name = "";
            $scope.$Alumno.dates.fln = "";
            $scope.$Alumno.dates.sln = "";
            $scope.$Alumno.dates.id = "";
            $scope.$Materias = 1;
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.deleteAlumno = function (id,ev) {
        $http({
            method: 'delete',
            url: 'php/Alumno/delete.php',
            data: {
                id: id
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectAlumno(); //Update the table
            $scope.$Alumno.dates.name = "";
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.goToAlumno = function(id, ev){
        $http({
            method: 'post',
            url: 'php/Alumno/selectById.php',
            data: {
                id: id
            }
        }).then(function (response) {
            $timeout(function () {
                console.log('$timeout was executed');
                $scope.$apply(function () {
                    $scope.$Alumno.dates.name = response.data[0].nombre,
                    $scope.$Alumno.dates.fln = response.data[0].apellido1,
                    $scope.$Alumno.dates.sln = response.data[0].apellido2,
                    $scope.$Alumno.dates.id = parseInt(response.data[0].id),
                    $scope.$Alumno.dates.materia = parseInt(response.data[0].materiaId),
                    $scope.$Materias = parseInt(response.data[0].materiaId),
                    console.log($scope.$Alumno.dates.materia);
                });
            }, 0);
            console.log(response);
        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };

////////////////////////////////////////////////////////ARTICULO//////////////////////////////////////
    $scope.$Articulo = {
            dates: {
                id: 0,
                clave: "",
                description: "",
                image: "",
                cost: 0,
                pifi: 0,
                stock: 0
            }
    };

    $scope.changeValuePifis = function (val,type) {
        $scope.$Articulo.dates.pifi = val;
        console.log($scope.$Articulo.dates.pifi);
    };

    $scope.selectPifi = function () {
        $http({
            method: 'get',
            url: 'php/Articulo/selectPifi.php'
        }).then(function (response) {
            $scope.$listPifi = response.data;
            console.log($scope.$listPifi);
        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };

    $scope.selectArticulo = function () {
        $http({
            method: 'get',
            url: 'php/Articulo/select.php'
        }).then(function (response) {
            $scope.$listArticulo = response.data;
            console.log($scope.$listArticulo);
        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };

    $scope.selectPifi();
    $scope.selectArticulo();
    //Insert a new Alumno

    $scope.submitArticulo = function () {
        //alert($scope.$Articulo.dates.pifi);
        $http({
            method: 'post',
            url: 'php/Articulo/insert.php',
            data: {
                id: $scope.$Articulo.dates.id,
                clave: $scope.$Articulo.dates.clave,
                descripcion: $scope.$Articulo.dates.description,
                imagen: $scope.$Articulo.dates.image,
                costo: $scope.$Articulo.dates.cost,
                stock: $scope.$Articulo.dates.stock,
                pifi_id: $scope.$Articulo.dates.pifi
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectArticulo(); //Update the table
                    /*$scope.$Articulo.dates.id = 0,
                    $scope.$Articulo.dates.clave = "",
                    $scope.$Articulo.dates.description = "",
                    $scope.$Articulo.dates.image = "",
                    $scope.$Articulo.dates.cost= 0,
                    $scope.$Articulo.dates.stock= 0,
                    $scope.$Articulo.dates.pifi= 0*/
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.updateArticulo = function () {
        $http({
            method: 'put',
            url: 'php/Articulo/update.php',
            data: {
                id: $scope.$Articulo.dates.id,
                clave: $scope.$Articulo.dates.clave,
                descripcion: $scope.$Articulo.dates.description,
                imagen: $scope.$Articulo.dates.image,
                costo: $scope.$Articulo.dates.cost,
                stock: $scope.$Articulo.dates.stock,
                pifi_id: $scope.$Articulo.dates.pifi
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectArticulo(); //Update the table
                    $scope.$Articulo.dates.id = 0,
                    $scope.$Articulo.dates.clave = "",
                    $scope.$Articulo.dates.description = "",
                    $scope.$Articulo.dates.image = "",
                    $scope.$Articulo.dates.cost= 0,
                    $scope.$Articulo.dates.stock= 0,
                    $scope.$Articulo.dates.pifi= 0
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.deleteArticulo = function (id,ev) {
        $http({
            method: 'delete',
            url: 'php/Articulo/delete.php',
            data: {
                id: id
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectArticulo(); //Update the table
                    $scope.$Articulo.dates.id = 0,
                    $scope.$Articulo.dates.clave = "",
                    $scope.$Articulo.dates.description = "",
                    $scope.$Articulo.dates.image = "",
                    $scope.$Articulo.dates.cost= 0,
                    $scope.$Articulo.dates.stock= 0,
                    $scope.$Articulo.dates.pifi= 0
                    //$scope.$Pifis = ""
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };

    $scope.goToArticulo = function(id, ev){
        $http({
            method: 'post',
            url: 'php/Articulo/selectById.php',
            data: {
                id: id
            }
        }).then(function (response) {
            $timeout(function () {
                console.log('$timeout was executed');
                $scope.$apply(function () {
                    $scope.$Articulo.dates.id = parseInt(response.data[0].id),
                    $scope.$Articulo.dates.clave = response.data[0].clave,
                    $scope.$Articulo.dates.description = response.data[0].descripcion,
                    $scope.$Articulo.dates.image = response.data[0].imagen,
                    $scope.$Articulo.dates.cost= parseInt(response.data[0].costo),
                    $scope.$Articulo.dates.stock= parseInt(response.data[0].stock),
                    $scope.$Articulo.dates.pifi= response.data[0].clavepifi,
                    $scope.$Pifis = response.data[0].clavepifi
                });
            }, 0);
            console.log(response);
        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };

    $scope.findArticulo = function(id, ev){
        $http({
            method: 'post',
            url: 'php/Articulo/selectByName.php',
            data: {
                clave: id
            }
        }).then(function (response) {
            $timeout(function () {
                console.log('$timeout was executed');
                $scope.$apply(function () {
                    $scope.$Articulo.dates.id = parseInt(response.data[0].id),
                    $scope.$Articulo.dates.clave = response.data[0].clave,
                    $scope.$Articulo.dates.description = response.data[0].descripcion,
                    $scope.$Articulo.dates.image = response.data[0].imagen,
                    $scope.$Articulo.dates.cost= parseInt(response.data[0].costo),
                    $scope.$Articulo.dates.stock= parseInt(response.data[0].stock),
                    $scope.$Articulo.dates.pifi= response.data[0].clavepifi,
                    $scope.$Pifis = response.data[0].clavepifi
                });
            }, 0);
            console.log(response);
        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };


      //---------------------- PROFESOR ----------------------

    $scope.$profesor = {
            data: {
                id: "",
                name: ""
            }
    };

    $scope.selectProfesor = function () {
        $http({
            method: 'get',
            url: 'php/Profesor/select.php'
        }).then(function (response) {
            $scope.$listProfesor = response.data;

        }, function (error) {
            console.log(error, 'cant get data.');
        });
    };

    $scope.submitProfesor = function () {
        $http({
            method: 'post',
            url: 'php/Profesor/insert.php',
            data: {
                id: $scope.$profesor.data.id,
                nombre: $scope.$profesor.data.name
            }
        }).then(function (response) {
            console.log(response);
            $scope.selectProfesor(); //Update the table
            $scope.$profesor.data.name = "";
            //Para notificacion exitosa
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Exitosa')
                    .position(pinTo)
                    .hideDelay(3000)
            );
            //En caso de error
        }, function (error) {
            var pinTo = $scope.getToastPosition();
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Operación Fallida')
                    .position(pinTo)
                    .hideDelay(3000)
            );
        });
    };


});
