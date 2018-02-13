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
@php
if (@$_GET['page'] > $e = ceil($siswa->total()/5)) {
	@endphp  <script>window.location = "/404";</script> @php
}
@endphp
<div class="w3-container w3-padding-16 w3-red">
  <a href="/"><h2 class="title">Website Sekolah</h2></a>
 </div>
<div class="w3-row">
<div class="w3-col s4">
 <div class="form_container">
 	<div class="w3-container w3-green">
 	   <h2 class="title">Pengisian Data Siswa</h2>
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
  	   	 <button class="@{{formsiswa.$valid ? 'w3-btn w3-green' : 'w3-btn w3-green w3-disabled'}}" type="submit" ng-click="tambahdata()">Tambah Data</button>
  	   	 {{ csrf_field() }}
  	   </p>
	</form>
 </div>
</div>
<div class="w3-col s6">
 <div class="data_container">
  <div class="w3-container w3-green">
    <h2 class="title">Data Siswa</h2>
  </div>
    @if ($siswa->count() > 0)
     <table class="w3-table">
    	<tr>
      		<th>Nama Siswa</th>
      		<th>No Absen</th>
      		<th>Kelas</th>
      		<th>Konfigurasi</th>
    	</tr>
      @foreach ($siswa as $siswas)
      	<tr>
   			<td>{{$siswas->nama}}</td>
      		<td>{{$siswas->noabsen}}</td>
        	<td>{{$siswas->kelas}}</td>
        	<td><a href="/datasiswa/{{$siswas->id}}/edit" class="w3-text-red">Edit Data</a> | <a href="#" class="w3-text-red" ng-click="hapusdata({{$siswas->id}})">Hapus Data</a></td>
      	</tr>
      @endforeach
    </table>
     <div class="w3-bar w3-center pagination_container">
  	  @if ($siswa->onFirstPage() && !$siswa->hasMorePages())
  		<a href="/" class="w3-btn w3-green w3-disabled">Selanjutnya</a>
      @elseif ($siswa->onFirstPage())
 		<a href="{{ $siswa->nextPageUrl() }}" class="w3-btn w3-green">Selanjutnya</a>
      @elseif (!$siswa->onFirstPage() && $siswa->hasMorePages())
        <a href="{{ $siswa->PreviousPageUrl() }}" class="w3-btn w3-green">Sebelumnya</a>
        <a href="{{ $siswa->nextPageUrl() }}" class="w3-btn w3-green">Selanjutnya</a>
      @else
        <a href="{{ $siswa->PreviousPageUrl() }}" class="w3-btn w3-green">Sebelumnya</a>
      @endif
     </div>
    @else
       <div class="w3-center w3-text-red nodata_text">Tidak ada data siswa yang harus ditampilkan</div>
    @endif
 </div>
</div>
</div>
 <script type="text/javascript">
    var websekolah = angular.module('websekolahApp', []);

  websekolah.controller('websekolahControll', function($scope, $http) {

      $http.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

      $scope.tambahdata = function() {
        $http({
        method: "post",
        url: "/proses/tambahdata",
        data: {
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
              $scope.namasiswa = "";
                $scope.noabsen   = "";
              $scope.kelas     = "";
              $scope.formsiswa.$setPristine();
              $scope.formsiswa.$setUntouched();
              swal(result['Title'], result['Message'], result['PopupType']);
            break;

            case '1GUp5Mz1ok':
              swal(result['Title'], result['Message'], result['PopupType']);
            break;
          }
       });
      }

      $scope.hapusdata = function(id) {
        $http({
        method: "post",
        url: "/proses/hapusdata",
        data: {
            id : id
        },
        headers: {'Content-Type': 'application/json'}
      }).then(function (response) {

        var result = angular.fromJson(response.data);

        switch(result['Type'])
        {
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