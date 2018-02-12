<!DOCTYPE html>
<html>
<head>
	<title>Website Sekolah</title>
	<link rel="stylesheet" type="text/css" href="/css/default.css">
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body ng-app="websekolahApp" ng-controller="websekolahControll">
  <div class="w3-container w3-padding-16 w3-red">
    <a href="/"><h2 class="title">Website Sekolah</h2></a>
  </div>
 <div class="editdata_container">
 	<div class="w3-container w3-green">
 	   <h2 class="title">Edit Data Siswa</h2>
    </div>
	<form class="w3-container" method="POST" name="formsiswa">
  	   <p>
  		<label>Nama Siswa</label>
  		<input class="w3-input w3-border" type="text" name="namasiswa" ng-model="namasiswa" ng-pattern="/^[a-zA-Z ]*$/" ng-minlength="5" ng-maxlength="25" required>
  		<div ng-show="formsiswa.namasiswa.$touched && formsiswa.namasiswa.$error.required" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        Nama lengkap harus diisi !
 		</div>
 		<div ng-show="formsiswa.namasiswa.$error.minlength" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        Nama lengkap minimal terdapat 5 huruf !
 		</div>
 		<div ng-show="formsiswa.namasiswa.$error.maxlength" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        Nama lengkap maksimal terdapat 25 huruf !
 		</div> 
    <div ng-show="formsiswa.namasiswa.$error.pattern" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        Nama hanya boleh berisi huruf dan spasi !
    </div>
  	   </p>
	   <p>
 	    <label>No Absen</label>
  		<input class="w3-input w3-border" type="text" name="noabsen" ng-model="noabsen" ng-pattern="/^[0-9]*$/" ng-minlength="2" ng-maxlength="2" required>
  		<div ng-show="formsiswa.noabsen.$touched && formsiswa.noabsen.$error.required" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        No absen harus diisi !
 		</div>
  		<div ng-show="formsiswa.noabsen.$error.minlength" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        No absen harus terdiri dari 2 digit ! Contoh : Jika no absen 3 maka input 03
 		</div>
 		<div ng-show="formsiswa.noabsen.$error.maxlength" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        No absen harus terdiri dari 2 digit ! Contoh : Jika no absen 3 maka input 03 
 		</div>
    <div ng-show="formsiswa.noabsen.$error.pattern" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        No absen hanya boleh berisi angka !
    </div>
  	   </p>
  	   <p>
  		<label>Kelas</label>
  		<input class="w3-input w3-border" type="text" name="kelas" ng-model="kelas" ng-pattern="/^[a-zA-Z-0-9 ]*$/" ng-minlength="3" ng-maxlength="20" required>
  		<div ng-show="formsiswa.kelas.$touched && formsiswa.kelas.$error.required" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        Kelas harus diisi !
 		</div>
 		<div ng-show="formsiswa.kelas.$error.minlength" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        Kelas minimal terdapat 3 karakter !
 		</div>
 		<div ng-show="formsiswa.kelas.$error.maxlength" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        Kelas minimal terdapat 20 karakter !
 		</div>
    <div ng-show="formsiswa.kelas.$error.pattern" class="w3-text-red w3-padding-16 w3-margin-16 w3-animate-opacity">
        Kelas hanya boleh berisi huruf, angka dan spasi !
    </div>
  	   </p>
  	   <p>
  	   	 <button class="@{{formsiswa.$valid ? 'w3-btn w3-green' : 'w3-btn w3-green w3-disabled'}}" type="submit" ng-click="editdata()">Edit Data</button>
  	   	 {{ csrf_field() }}
  	   </p>
	</form>
 </div>
 <script type="text/javascript">
    var websekolah = angular.module('websekolahApp', []);

      websekolah.controller('websekolahControll', function($scope, $http) {

          $http.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

          $scope.namasiswa = "{{$siswa->nama}}";

          $scope.noabsen   = "{{$siswa->noabsen}}";

          $scope.kelas     = "{{$siswa->kelas}}";

          $scope.editdata = function() {
        $http({
        method: "post",
        url: "/proses/memperbaharuidata",
        data: {
            id        : {{$siswa->id}},
            namasiswa : $scope.namasiswa,
            noabsen   : $scope.noabsen,
            kelas     : $scope.kelas
        },
        headers: {'Content-Type': 'application/json'}
      }).then(function (response) {

        var result = angular.fromJson(response.data);

        switch(result['Type'])
          {
            case 'ieEzkReNTw':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'oGGINTJG9p':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'eZ6Bitr69s':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'qAnycbYrr6':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'uCx17HlaBH':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'xoScnjfF3c':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'PoLuNHsZcT':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'zunwHknqqp':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'rrxt9YmdZu':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'diLpAKp0s9':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case 'agqroJNDRE':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case '0vwaxl8NI4':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case '1GUp5Mz1ok':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;
          }
       });
      }
     });
 </script>
</body>
</html>