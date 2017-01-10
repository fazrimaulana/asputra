@extends('layouts.frontend.app')

@section('content')
  
  <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">AS PUTRA</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <!-- <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li> -->
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    @if (!Auth::check())
                      <li><a class="page-scroll" href="{{ url('/login') }}">Login</a></li>
                      <li><a class="page-scroll" href="{{ url('/register') }}">Register</a></li>
                    @endif
                    @hasrole('Konsumen')
                    <li>
                      <a class="page-scroll" href="#pesan">Pesan Telur</a>
                    </li>
                    @endhasrole
                    @if(Auth::check())
                    <li>
                      <a href="{{url('/logout')}}" class="page-scroll" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                      </form>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">AS PUTRA</h1>
                <hr>
                <p>Produksi Telur Daerah Kuningan Jawa Barat</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">AS Putra About</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">AS PUTRA KUNINGAN</h2>
                    <hr class="light">
                    <p class="text-faded">AS Putra Kuningan merupakan pabrik yang berjalan dalam produksi telur. Pabrik AS Putra ini terletak di Desa Winduhaji Kecamatan Kuningan Kabupaten Kuningan Provinsi Jawa Barat. Pabrik AS Putra ini telah berjalan sejak tahun 2000 dan berjalan sampai sekarang. AS Putra juga memiliki beberapa cabang di beberapa daerah seperti daerah Cikijing dan Indramayu.</p>
                    <!-- <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Welcome in AS Putra Site !!!</a> -->
                </div>
            </div>
        </div>
    </section>

    <!-- <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                        <h3>Sturdy Templates</h3>
                        <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Ready to Ship</h3>
                        <p class="text-muted">You can use this theme as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Up to Date</h3>
                        <p class="text-muted">We update dependencies to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Made with Love</h3>
                        <p class="text-muted">You have to make your websites with love these days!</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">
                @foreach($galeries as $image)
                <div class="col-lg-4 col-sm-6">
                    <a href="{{ asset('image/'.$image->foto) }}" class="portfolio-box">
                        <img src="{{ asset('image/'.$image->foto) }}" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    <!-- Category -->
                                </div>
                                <div class="project-name">
                                    {{$image->deskripsi}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Free Download at Start Bootstrap!</h2>
                <a href="http://startbootstrap.com/template-overviews/creative/" class="btn btn-default btn-xl sr-button">Download Now!</a>
            </div>
        </div>
    </aside> -->

    @hasrole('Konsumen')
    <section id="pesan">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-6">
                    <div id="error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="section-heading text-center">Form Pemesanan Telur</h2>
                    <hr class="primary">
                    <p class="text-center">
                    Terima Kasih Telah Mengunjungi AS Putra<br>
                    Silahkan Masukkan Pesanan Anda
                    </p>
                    <form method="post" action="{{ url('/home#pesan') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="action" name="action" value="{{old('action')}}">
                    <input type="hidden" id="id" name="id">
                        <div class="form-group{{ $errors->has('tgl_pemesanan') ? ' has-error' : '' }}">
                            <label class="control-label">Tanggal Pemesanan</label>
                            <input type="text" class="form-control" placeholder="Tanggal Pemesanan" value="{{$date}}" name="tgl_pemesanan" id="tgl-pemesanan">
                            @if($errors->has('tgl_pemesanan'))
                                <span style="color: red;">{{ $errors->first('tgl_pemesanan') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('jml_pemesanan') ? ' has-error' : '' }}">
                            <label class="control-label">Jumlah Pemesanan (Per Peti)</label>
                            <input type="number" class="form-control jml_pemesanan key" id="jml-pemesanan" placeholder="Jumlah Pemesanan" name="jml_pemesanan" value="{{ old('jml_pemesanan') }}">
                            @if($errors->has('jml_pemesanan'))
                                <span style="color: red;">{{ $errors->first('jml_pemesanan') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label class="control-label">Alamat</label>
                            <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}" id="alamat">
                            @if($errors->has('alamat'))
                                <span style="color: red;">{{ $errors->first('alamat') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('no_hp') ? ' has-error' : '' }}">
                            <label class="control-label">No Handphone</label><br>
                                <input type="number" class="form-control" placeholder="No Handphone" name="no_hp" value="{{ old('no_hp') }}" id="no_hp">
                            @if($errors->has('no_hp'))
                                <span style="color: red;">{{ $errors->first('no_hp') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('harga_per_peti') ? ' has-error' : '' }}">
                            <label class="control-label">Harga Per Peti</label>
                            <input type="text" class="form-control harga" id="harga" placeholder="Harga Per Peti" name="harga_per_peti" value="200000" readonly="readonly">
                            @if($errors->has('harga_per_peti'))
                                <span style="color: red;">{{ $errors->first('harga_per_peti') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                            <label class="control-label">Total</label>
                            <input type="text" class="form-control total" id="total" placeholder="Total" name="total" value="{{ old('total') }}" readonly="readonly">
                            @if($errors->has('total'))
                                <span style="color: red;">{{ $errors->first('total') }}</span>
                            @endif
                        </div>
                        <br>
                        <button value="Save" class="btn btn-md btn-primary">Pesan</button>
                    </form>
                </div>
                
                <div class="col-lg-6 text-center">
                    <h2 class="section-heading">Data Pemesanan Telur</h2>
                    <hr class="primary">
                    <p class="text-center">
                    Data Pemesanan Telur Anda<br>
                    </p>
                    <table class="table table-bordered">
                        <tr>
                            <td>No</td>
                            <td>Tanggal Pemesanan</td>
                            <td>Jumlah Pemesanan</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        @foreach($pemesanan as $dataPemesanan)
                        <tr class="item{{$dataPemesanan->id_pemesanan}}">
                            <td>{{ $no++ }}.</td>
                            <td>{{ $dataPemesanan->tgl_pemesanan }}</td>
                            <td>{{ $dataPemesanan->jml_pemesanan }} Peti</td>
                            <td class="status{{ $dataPemesanan->id_pemesanan }}">
                            @if($dataPemesanan->konfirmasi_pemesanan=='y')
                                <button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Telah di Konfirmasi"><span class="glyphicon glyphicon-ok"></span></button>
                            @else
                                <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Menunggu Konfirmasi"><span class="glyphicon glyphicon-refresh"></span></button>
                            @endif
                            </td>
                            <td class="action{{ $dataPemesanan->id_pemesanan }}">
                            @if($dataPemesanan->konfirmasi_pemesanan=='y')
                                <button class="btn btn-info" disabled="disabled"><i class="glyphicon glyphicon-edit"></i></button>
                                <button class="btn btn-danger" disabled="disabled"><i class="glyphicon glyphicon-trash"></i></button>
                            @else
                                <button class="btn btn-info edit-modal" value="{{$dataPemesanan->id_pemesanan}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="glyphicon glyphicon-edit"></i></button>
                                <button class="btn btn-danger delete-modal" data-id="{{$dataPemesanan->id_pemesanan}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $pemesanan->fragment('pesan')->links() }}

                </div>
            </div>
        </div>
    </section>
    @endhasrole

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Ayo Pesan Telur ke AS PUTRA</h2>
                    <hr class="primary">
                    <p>Kami selalu berusaha memberikan pelayanan terbaik untuk anda, silahkan hubungi kami dengan contact !!!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:your-email@your-domain.com">as.putra@gmail.com <div id="show"></div></a></p>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade bs-example-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah Data</h4>
                </div>
                <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <input type="hidden" name="id-edit" id="id-edit">
                        <label class="control-label">Tanggal Pemesanan</label>
                        <input type="text" name="tgl_pemesanan_edit" id="tgl_pemesanan_edit" class="form-control" placeholder="Tanggal Pemesanan" required="required">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jumlah Pemesanan</label>
                        <input type="text" name="jml_pemesanan_edit" id="jml_pemesanan_edit" class="form-control jml_pemesanan_edit" placeholder="Jumlah Pemesanan">
                        @if ($errors->has('jml_pemesanan_edit')) <p class="help-block">{{ $errors->first('jml_pemesanan_edit') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Harga (Per Peti)</label>
                        <input type="text" name="harga_per_peti_edit" id="harga_per_peti_edit" class="form-control harga_edit" placeholder="Harga Per Peti" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Total</label>
                        <input type="text" name="total_edit" id="total-edit" class="form-control total_edit" placeholder="Total" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                        <input type="text" name="alamat_edit" id="alamat_edit" class="form-control" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label class="control-label">No HP</label>
                        <input type="text" name="no_hp_edit" id="no_hp_edit" class="form-control" placeholder="no_hp">
                    </div>
                    <div class="form-group" align="right">
                        <button type="button" id="edit" class="btn btn-primary" data-dismiss="modal">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete Data Produksi</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              {{ csrf_field() }}
              <input type="hidden" name="id-delete" id="id-delete">
              <p>Yakin Ingin Menghapus Data? </p>
            </div>
            <div class="form-group" align="right">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" id="delete" class="btn btn-danger" data-dismiss="modal">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">

    $(document).ready(function() {     

        $('[data-toggle="tooltip"]').tooltip();        

        $(".total").val("0");
        $(".jml_pemesanan").val("");

        function calc() {
            var $num1 = ($.trim($(".jml_pemesanan").val()) != "" && !isNaN($(".jml_pemesanan").val())) ? parseInt($(".jml_pemesanan").val()) : 0;
            console.log($num1);
            var $num2 = ($.trim($(".harga").val()) != "" && !isNaN($(".harga").val())) ? parseInt($(".harga").val()) : 0;
            console.log($num2);
            $(".total").val($num1 * $num2);
        }
        $(".jml_pemesanan").keyup(function() {
            calc();
        });


        function calcEdit() {
            var $num1 = ($.trim($(".jml_pemesanan_edit").val()) != "" && !isNaN($(".jml_pemesanan_edit").val())) ? parseInt($(".jml_pemesanan_edit").val()) : 0;
            console.log($num1);
            var $num2 = ($.trim($(".harga_edit").val()) != "" && !isNaN($(".harga_edit").val())) ? parseInt($(".harga_edit").val()) : 0;
            console.log($num2);
            $(".total_edit").val($num1 * $num2);
        }

        $(".jml_pemesanan_edit").keyup(function() {
            calcEdit();
        });


        
        $('#tgl-pemesanan').datepicker({
            format: "yyyy/mm/dd",
            autoclose:true,
            todayHighlight: true
        });

        $('#tgl_pemesanan_edit').datepicker({
            format: "yyyy/mm/dd",
            autoclose:true,
            todayHighlight: true
        });


        $(document).on('click', '.edit-modal', function() {
            $id = $(this).val();
            $.ajax({
                type: 'get',
                url: 'pemesanan/'+$id+'/getData',
                success: function(data) {   
                           
                    $('#id-edit').val(data.id_pemesanan);
                    $('#tgl_pemesanan_edit').val(data.tgl_pemesanan);
                    $('#jml_pemesanan_edit').val(data.jml_pemesanan);
                    $('#harga_per_peti_edit').val(data.harga_per_peti);
                    $('#total-edit').val(data.total);
                    $('#alamat_edit').val(data.alamat);
                    $('#no_hp_edit').val(data.no_hp);
                    $('.bs-example-modal').modal('show');

                    console.log(data);
                },
                error: function()
                {
                     alert('gagal');   
                }
            });


        });

        $("#edit").click(function() {

            $.ajax({
                type: 'post',
                url: 'pemesanan/update',
                data: {
                 '_token': $('input[name=_token]').val(),
                 'id' : $('input[name=id-edit]').val(),
                 'tgl_pemesanan': $('input[name=tgl_pemesanan_edit]').val(),
                 'jml_pemesanan': $('input[name=jml_pemesanan_edit]').val(),
                 'harga_per_peti': $('input[name=harga_per_peti_edit]').val(),
                 'total': $('input[name=total_edit]').val(),
                 'alamat': $('input[name=alamat_edit]').val(),
                 'no_hp': $('input[name=no_hp_edit]').val()
                },
                success: function(data) {
                    /*$('.item' + data.id_pemesanan).replaceWith("<tr class='item" + data.id_pemesanan + "'><td>" + data.id_pemesanan + "</td><td>" + data.tgl_pemesanan + "</td><td>" + data.jml_pemesanan + " Peti</td><td> <button class='btn btn-danger'><span class='glyphicon glyphicon-refresh'></span></button>"+"</td><td> <button class='btn btn-info edit-modal' value='"+ data.id_pemesanan +"' ><i class='glyphicon glyphicon-edit'></i></button> <button class='btn btn-danger delete-modal' data-id='"+ data.id_pemesanan +"'><i class='glyphicon glyphicon-trash'></i></button>  </td></tr>"); */  

                    /*console.log(data);*/
                    if (data=="error") {
                        /*alert('Isi Form dengan benar');*/
                        $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Update Gagal, Isi Form dengan Benar!!!</div>');
                        $('#error').show();
                        console.log(data);                        
                    }
                    else
                    {
                        setTimeout(function(){// wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                        }, 0);   
                    }
                },
                error: function()
                {
                     alert('gagal');   
                }
            });
        });


        $(document).on('click', '.delete-modal', function() {
            $('#id-delete').val($(this).data('id'));
            $('.bs-example-modal-sm3').modal('show');
        });



        $("#delete").click(function() {
            $.ajax({
                type: 'post',
                url: 'delete/pemesanan',
                data: {
                 '_token': $('input[name=_token]').val(),
                 'id' : $('input[name=id-delete]').val()
                },
                success: function(data) {
                     $('.item' + data.id_pemesanan).remove();
                     
                     console.log(data);
                }
            });
        });

        

    });

    </script>
    <script src="https://js.pusher.com/3.2/pusher.js"></script>
<script>
/*Pusher.logToConsole = true;*/

var pusher = new Pusher('{{env("PUSHER_KEY")}}');
var channel = pusher.subscribe('my-konfir-pemesanan');
channel.bind('my-konfir-pemesanan', function(data){
    console.log(data.konfir_pemesanan);
    $(".status"+data.konfir_pemesanan).replaceWith("<td class='status'"+ data.konfir_pemesanan +"><button class='btn btn-info' data-toggle='tooltip' data-placement='bottom' title='Telah di Konfirmasi'><span class='glyphicon glyphicon-ok'></span></button></td>");
    $(".action"+data.konfir_pemesanan).replaceWith("<td class='action'"+ data.konfir_pemesanan +"><button class='btn btn-info' disabled='disabled'><i class='glyphicon glyphicon-edit'></i></button><button class='btn btn-danger' disabled='disabled'><i class='glyphicon glyphicon-trash'></i></button></td>");

});

</script>
@stop
