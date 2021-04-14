@extends('adminlte::page')

@section('title', 'Pengelolaan Buku')

@section('content_header')
    <h1 class="m-0 text-dark">Pengelolaan Buku</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Pengelolaan Buku') }} <button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>Tambah Data</button></div>
                <div class="card-body">
                    
                    <table id="table-data" class="table table-borderer">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>JUDUL</th>
                                <th>PENULIS</th>
                                <th>TAHUN</th>
                                <th>PENERBIT</th>
                                <th>COVER</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $key => $book )
                                <tr class="tengahflex">
                                    <td style="padding-top: 10px">{{ $key+1 }}</td>
                                    <td style="padding-top: 10px">{{ $book->judul }}</td>
                                    <td style="padding-top: 10px">{{ $book->penulis }}</td>
                                    <td style="padding-top: 10px">{{ $book->tahun }}</td>
                                    <td style="padding-top: 10px">{{ $book->penerbit }}</td>
                                    <td>
                                        @if ($book->cover !== null)
                                            <div class="coverdiv" style="max-height:60px; max-width:60px; overflow:hidden; text-align:center;"><img src="{{ asset('storage/cover_buku/'.$book->cover) }}" alt="{{ $book->judul }}" height='60'></div>
                                        @else
                                            [Gambar tidak tersedia]
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <button type="button" id="btn-edit-buku" class="btn btn-success" data-toggle="modal" data-target="#editBukuModal" data-id="{{ $book->id }}">edit</button>
                                          <button type="button" id="btn-delete-buku" class="btn btn-danger" data-toggle="modal" data-target="#deleteBukuModal" data-id="{{ $book->id }}" data-cover="{{ $book->cover }}">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.book.submit') }}" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="judul">Judul Buku</label>
            <input type="text" class="form-control" name="judul" id="judul" required>
          </div>
          <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" class="form-control" name="penulis" id="penulis" required>
          </div>
          <div class="form-group">
            <label for="tahun">Tahun</label>
            <input type="text" class="form-control" name="tahun" id="tahun" required>
          </div>
          <div class="form-group">
            <label for="penerbit">Penerbit</label>
            <input type="text" class="form-control" name="penerbit" id="penerbit" required>
          </div>
          <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" class="form-control" name="cover" id="cover" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" style="padding: 5px 20px 5px 20px;">kirim!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal2 -->
<div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.book.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit-judul">Judul Buku</label>
                <input type="text" class="form-control" name="judul" id="edit-judul" required>
              </div>
              <div class="form-group">
                <label for="edit-penulis">Penulis</label>
                <input type="text" class="form-control" name="penulis" id="edit-penulis" required>
              </div>
              <div class="form-group">
                <label for="edit-tahun">Tahun</label>
                <input type="text" class="form-control" name="tahun" id="edit-tahun" required>
              </div>
              <div class="form-group">
                <label for="edit-penerbit">Penerbit</label>
                <input type="text" class="form-control" name="penerbit" id="edit-penerbit" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="image-area" style="text-align:center; width:100;"></div>
              <div class="form-group">
                <label for="edit-cover">Cover</label>
                <input type="file" class="form-control" name="cover" id="edit-cover">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <input type="hidden" name="id" id="edit-id">
            <input type="hidden" name="old_cover" id="edit-old-cover">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 5px 20px 5px 20px;">Tutup</button>
            <button type="submit" class="btn btn-primary" style="padding: 5px 20px 5px 20px;">Update!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- modal3 -->

<div class="modal fade" id="deleteBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=exampleModalLabel>Hapus Data Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data tersebut?.</p>
        <form method="post" action="{{ route('admin.book.delete') }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
          <div class="modal-footer">
            <input type="hidden" name="id" id="delete-id">
            <input type="hidden" name="old_cover" id="delete-old-cover">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-primary">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@stop


@section('js')

<script>
  $(function(){

    $(document).on('click', '#btn-edit-buku', function(){
      let id = $(this).data('id');
      $('#image-area').empty();

      let baseurl = "http://localhost:8000";

      $.ajax({
        type: "get",
        url: baseurl+'/admin/ajaxadmin/dataBuku/'+id,
        dataType: 'json',
        success: function(res){
          $('#edit-judul').val(res.judul);
          $('#edit-penerbit').val(res.penerbit);
          $('#edit-penulis').val(res.penulis);
          $('#edit-tahun').val(res.tahun);
          $('#edit-id').val(res.id);
          $('#edit-old-cover').val(res.cover);

          if(res.cover !==null){
            $('#image-area').append(
              "<img src='"+baseurl+"/storage/cover_buku/"+res.cover+"' width=200px'>"
            );
          }else{
            $('#image-area').append('[Gambar tidak tersedia]');
          }
        }


      });
    });

    $(document).on('click', '#btn-delete-buku', function(){
    let id = $(this).data('id');
    let cover = $(this).data('cover');

    $('#delete-id').val(id);
    $('#delete-old-cover').val(cover);
  });

  });

 
</script>


@stop