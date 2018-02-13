<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\HomeModel;

class HomeController extends Controller
{
    public function index()
    {

      $HomeModel  = new HomeModel;

    	$siswa      = $HomeModel->orderBy('id', 'desc')->paginate(5)->setPath('datasiswa');
    	return view('home', ['siswa' => $siswa]);
    }

    public function PreventDirectAccess()
    {
    	return redirect('/');
    }

    public function errorpage()
    {
    	return view('404');
    }

    public function cekdata($Datayangmaudicek = NULL, $Datanya = NULL)
    {
    	if (is_null($Datayangmaudicek) || empty($Datayangmaudicek))
    	{
    		return response()->json(['Status' => 'Data Masih Kosong!', 'Message' => 'Kesalahan, data yang mau dicek tidak ada']);
    	}
    	else if (is_null($Datanya) || empty($Datanya))
    	{
    		return response()->json(['Status' => 'Data Masih Kosong!', 'Message' => 'Kesalahan, data nya masih kosong']);
    	}
    	else
    	{
    		$datasiswa = HomeModel::all();

    		foreach ($datasiswa as $siswa) {
    			switch ($Datayangmaudicek) {
    				case 'nama':
    					if ($siswa->nama == $Datanya) 
    					{
    						return TRUE;
    					}
    				break;
    				case 'noabsen':
    					if ($siswa->noabsen == $Datanya) 
    					{
    						return TRUE;
    					}
    				break;
    				case 'kelas':
    					if ($siswa->kelas == $Datanya) 
    					{
    						return TRUE;
    					}
    				break;
            case 'ceksemua':
              if ($siswa->nama == $Datanya[0] && $siswa->noabsen == $Datanya[1] && $siswa->kelas == $Datanya[2]) 
              {
                return TRUE;
              }
            break;
    				default:
    					return response()->json(['Status' => 'Data tidak tersedia!', 'Message' => 'Data yang mau dicek tidak tersedia']);
    				break;
    			}
    		}
    	}
    }

    public function tambahdata(Request $request)
    {
    	if ($request->ajax()) 
    	{

    	  if (empty($request->namasiswa))
    	  {
    	  	 return response()->json(['Type' => 'ieEzkReNTw' , 'Title' => 'Kesalahan', 'Message' => 'Nama siswa masih kosong !', 'PopupType' => 'warning']);
    	  }
    	  else if (empty($request->noabsen))
    	  {
    	  	 return response()->json(['Type' => 'oGGINTJG9p' , 'Title' => 'Kesalahan', 'Message' => 'No absen masih kosong !', 'PopupType' => 'warning']);	 
    	  }
    	  else if (empty($request->kelas))
    	  {
    	  	 return response()->json(['Type' => 'eZ6Bitr69s' , 'Title' => 'Kesalahan', 'Message' => 'Kelas masih kosong !', 'PopupType' => 'warning']);
    	  }
    	  else if (strlen($request->namasiswa) < 5)
    	  {
    	  	 return response()->json(['Type' => 'qAnycbYrr6' , 'Title' => 'Kesalahan', 'Message' => 'Nama siswa minimal terdapat 5 huruf !', 'PopupType' => 'error']);	
    	  }
    	  else if (strlen($request->namasiswa) > 25)
    	  {
    	  	 return response()->json(['Type' => 'uCx17HlaBH' , 'Title' => 'Kesalahan', 'Message' => 'Nama siswa maksimal terdapat 25 huruf !', 'PopupType' => 'error']);	
    	  }
    	  else if (strlen($request->noabsen) < 2)
    	  {
    	  	 return response()->json(['Type' => 'xoScnjfF3c' , 'Title' => 'Kesalahan', 'Message' => 'No absen harus terdiri dari 2 digit !', 'PopupType' => 'error']);	
    	  }
    	  else if (strlen($request->noabsen) > 2)
    	  {
    	  	 return response()->json(['Type' => 'PoLuNHsZcT' , 'Title' => 'Kesalahan', 'Message' => 'No absen harus terdiri dari 2 digit !', 'PopupType' => 'error']);	
    	  }
    	  else if (!preg_match("/^[a-zA-Z ]*$/", $request->namasiswas))
    	  {
    	  	 return response()->json(['Type' => 'zunwHknqqp' , 'Title' => 'Kesalahan', 'Message' => 'Nama siswa hanya boleh berisi huruf dan spasi !', 'PopupType' => 'error']);	 
    	  }
    	  else if (!preg_match("/^[0-9]*$/", $request->noabsen))
    	  {
    	  	 return response()->json(['Type' => 'rrxt9YmdZu' , 'Title' => 'Kesalahan', 'Message' => 'No absen hanya boleh berisi angka !', 'PopupType' => 'error']);	 
    	  }
    	  else if (!preg_match("/^[a-zA-Z-0-9 ]*$/", $request->kelas))
    	  {
    	  	 return response()->json(['Type' => 'diLpAKp0s9' , 'Title' => 'Kesalahan', 'Message' => 'Kelas hanya boleh berisi huruf, angka dan spasi !', 'PopupType' => 'error']);	 
    	  }
    	  else if ($this->cekdata('ceksemua', array(0 => $request->namasiswa, 1 => $request->noabsen, 2 => $request->kelas)))
    	  {
    	  	 return response()->json(['Type' => 'agqroJNDRE' , 'Title' => 'Info', 'Message' => 'Data siswa yang anda masukkan sudah ada di dalam database', 'PopupType' => 'info']);
    	  }
    	  else
    	  {

    		  $HomeModel             = new HomeModel;

	    	  $HomeModel->nama       = $request->namasiswa;

      		$HomeModel->noabsen    = $request->noabsen;

	       	$HomeModel->kelas      = $request->kelas;
    
      		if ($HomeModel->save())
    	   	{
    		  	return response()->json(['Type' => '0vwaxl8NI4' , 'Title' => 'Sukses', 'Message' => 'Data anda berhasil ditambahkan !', 'PopupType' => 'success']);	 
    		  }
    		  else
    		  {
    			 return response()->json(['Type' => '1GUp5Mz1ok' , 'Title' => 'Kesalahan', 'Message' => 'Data anda tidak berhasil ditambahkan !', 'PopupType' => 'error']);	 
    		  }
    	  }
    	}
    	else
    	{
    		return redirect('/');
    	}
    }

    public function editdata($id)
    {
       $siswa = HomeModel::find($id);

       if (!$siswa)
       	 abort(404);


       return view('edit', ['siswa' => $siswa]);
    }

    public function memperbaharuidata(Request $request)
    {
        if ($request->ajax()) 
        {
    
          $siswa = HomeModel::find($request->id);

          if (!$siswa)
            return response()->json(['Status' => 'Error', 'Message' => 'Id data tidak ada di dalam database.']);

          if (empty($request->namasiswa))
          {
             return response()->json(['Type' => 'ieEzkReNTw' , 'Title' => 'Kesalahan', 'Message' => 'Nama siswa masih kosong !', 'PopupType' => 'warning']);
          }
          else if (empty($request->noabsen))
          {
             return response()->json(['Type' => 'oGGINTJG9p' , 'Title' => 'Kesalahan', 'Message' => 'No absen masih kosong !', 'PopupType' => 'warning']);   
          }
          else if (empty($request->kelas))
          {
             return response()->json(['Type' => 'eZ6Bitr69s' , 'Title' => 'Kesalahan', 'Message' => 'Kelas masih kosong !', 'PopupType' => 'warning']);
          }
          else if (strlen($request->namasiswa) < 5)
          {
             return response()->json(['Type' => 'qAnycbYrr6' , 'Title' => 'Kesalahan', 'Message' => 'Nama siswa minimal terdapat 5 huruf !', 'PopupType' => 'error']);  
          }
          else if (strlen($request->namasiswa) > 25)
          {
             return response()->json(['Type' => 'uCx17HlaBH' , 'Title' => 'Kesalahan', 'Message' => 'Nama siswa maksimal terdapat 25 huruf !', 'PopupType' => 'error']);    
          }
          else if (strlen($request->noabsen) < 2)
          {
             return response()->json(['Type' => 'xoScnjfF3c' , 'Title' => 'Kesalahan', 'Message' => 'No absen harus terdiri dari 2 digit !', 'PopupType' => 'error']);  
          }
          else if (strlen($request->noabsen) > 2)
          {
             return response()->json(['Type' => 'PoLuNHsZcT' , 'Title' => 'Kesalahan', 'Message' => 'No absen harus terdiri dari 2 digit !', 'PopupType' => 'error']);  
          }
          else if (!preg_match("/^[a-zA-Z ]*$/", $request->namasiswa))
          {
             return response()->json(['Type' => 'zunwHknqqp' , 'Title' => 'Kesalahan', 'Message' => 'Nama siswa hanya boleh berisi huruf dan spasi !', 'PopupType' => 'error']);     
          }
          else if (!preg_match("/^[0-9]*$/", $request->noabsen))
          {
             return response()->json(['Type' => 'rrxt9YmdZu' , 'Title' => 'Kesalahan', 'Message' => 'No absen hanya boleh berisi angka !', 'PopupType' => 'error']);     
          }
          else if (!preg_match("/^[a-zA-Z-0-9 ]*$/", $request->kelas))
          {
             return response()->json(['Type' => 'diLpAKp0s9' , 'Title' => 'Kesalahan', 'Message' => 'Kelas hanya boleh berisi huruf, angka dan spasi !', 'PopupType' => 'error']);   
          }
          else if ($this->cekdata('ceksemua', array(0 => $request->namasiswa, 1 => $request->noabsen, 2 => $request->kelas)))
          {
             return response()->json(['Type' => 'agqroJNDRE' , 'Title' => 'Info', 'Message' => 'Data siswa yang anda ingin perbaharui sudah ada di dalam database', 'PopupType' => 'info']);
          }
          else
          {
            $siswa->nama       = $request->namasiswa;

            $siswa->noabsen    = $request->noabsen;

            $siswa->kelas      = $request->kelas;
    
            if ($siswa->save())
            {
                return response()->json(['Type' => '0vwaxl8NI4' , 'Title' => 'Sukses', 'Message' => 'Data anda berhasil diperbaharui !', 'PopupType' => 'success']);  
            }
            else
            {
                return response()->json(['Type' => '1GUp5Mz1ok' , 'Title' => 'Kesalahan', 'Message' => 'Data anda tidak berhasil ditambahkan !', 'PopupType' => 'error']);   
            }
          }
        }
        else
        {
            return redirect('/');
        }
    }

    public function hapusdata(Request $request)
    {
        if ($request->ajax()) 
        {
    
          $siswa = HomeModel::find($request->id);

          if (!$siswa)
            return response()->json(['Status' => 'Error', 'Message' => 'Id data tidak ada di dalam database.']);

          if ($siswa->delete())
          {
              return response()->json(['Type' => '0vwaxl8NI4' , 'Title' => 'Sukses', 'Message' => 'Data anda berhasil dihapus !', 'PopupType' => 'success']);  
          }
          else
          {
              return response()->json(['Type' => '1GUp5Mz1ok' , 'Title' => 'Kesalahan', 'Message' => 'Data anda tidak berhasil dihapus !', 'PopupType' => 'error']);   
          }
        }
        else
        {
            return redirect('/');
        }
    }
}
