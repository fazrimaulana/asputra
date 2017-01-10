@foreach($pemesanan as $dataPemesanan)
@if($dataPemesanan->konfirmasi_pemesanan=='y')
                                <button class="btn btn-info" disabled="disabled"><i class="glyphicon glyphicon-edit"></i></button>
                                <button class="btn btn-danger" disabled="disabled"><i class="glyphicon glyphicon-trash"></i></button>
                            @else
                                <button class="btn btn-info edit-modal" value="{{$dataPemesanan->id_pemesanan}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="glyphicon glyphicon-edit"></i></button>
                                <button class="btn btn-danger delete-modal" data-id="{{$dataPemesanan->id_pemesanan}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                            @endif
                            @endforeach