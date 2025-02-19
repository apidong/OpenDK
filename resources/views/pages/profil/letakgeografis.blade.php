@extends('layouts.app')

@section('title','Letak Geografis')  

@section('content')
{{-- <section class="content"> --}}
    @if(!empty($profil))
    <div class="box box-primary hidden">
        <div class="box-header with-border">

            <div class="col-sm-12">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="{{ $sebutan_wilayah }}" class="col-sm-2 control-label">{{ $sebutan_wilayah }}</label>
                        <div class="col-sm-4">
                            <input type="hidden" id="profil_id" value="{{ $profil->id }}">
                            <select class="form-control" id="{{ $sebutan_wilayah }}" name="{{ $sebutan_wilayah }}" onchange=""></select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
            <!-- /.box-header -->
            {{-- <div class="row"> --}}
                <div class="col-md-8 col-sm-8">
                    <div class="box box-primary">
                        <div class="box-header with-border text-bold">
                            <h3 class="box-title text-bold"><i class="fa  fa-arrow-circle-right fa-lg text-blue"></i> LETAK GEOGRAFIS {{ strtoupper($sebutan_wilayah) }} {{ strtoupper($profil->nama_kecamatan) }}</h3>
                        </div>
                        <div class="box-body">
                            <div  id="canvas_peta">
                                <iframe id="btn_peta" src="{!! $profil->dataumum->embed_peta !!}" frameborder="0" style="border:0; width:100%; height:600px; margin: 0px!;" allowfullscreen></iframe>
                            </div>
                        </iframe>    
                    </div>
                                <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="box-footer">
                        <p style="text-align: justify">{{ ucwords(strtolower($sebutan_wilayah . ' ' . $profil->nama_kecamatan . ', Kabupaten ' . $profil->nama_kabupaten . ', Provinsi ' . $profil->nama_provinsi)) }} mempunyai <b> Luas {{ number_format($profil->dataumum->luas_wilayah_value) }} km<sup>2</sup></b> yang mencakup<b> {{ $profil->datadesa->count() }}  Desa/Kelurahan</b>.  Adapun <b> {{ terbilang($profil->datadesa->count()) }} Desa/Kelurahan </b> tersebut yaitu :
                            <ul>
                                @foreach($profil->datadesa as $desa)
                                <li>Desa {{ $desa->nama }}</li>
                                @endforeach
                            </ul>
                        </p>

                        <br/>

                        <h4 class="text-primary">Batas wilayah {{ $sebutan_wilayah }} {{ ucwords(strtolower($profil->nama_kecamatan)) }} meliputi :</h4>
                        <table>
                            <tbody>
                            <tr>
                                <th class="col-md-2">Utara</th>
                                <td class="col-md-9">
                                    : {{ ucwords($profil->dataumum->bts_wil_utara)  }}</td>
                            </tr>

                            <tr>
                                <th class="col-md-2">Timur</th>
                                <td class="col-md-9">: {{ $profil->dataumum->bts_wil_timur }}</td>
                            </tr>

                            <tr>
                                <th class="col-md-2">Selatan</th>
                                <td class="col-md-9">: {{ $profil->dataumum->bts_wil_selatan }}</td>
                            </tr>

                            <tr>
                                <th class="col-md-2">Barat</th>
                                <td class="col-md-9">: {{ $profil->dataumum->bts_wil_barat }}</td>
                            </tr>

                            </tbody>
                        </table>    
                    </div>
                </div>
            {{-- </div> --}}
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        Data Letak Geografis Belum Tersedia!
                    </div>
                </div>
            </div>
        </div>
    @endif
{{-- </section> --}}
@endsection
@push('scripts')
<script type="application/javascript" src="{{ asset('js/html2canvas.min.js') }}"></script>
<script type="application/javascript">
    document.querySelector("#btn_peta").addEventListener("click", function() {
        html2canvas(document.iframe).then(function(canvas) {
            document.body.appendChild(canvas);
        });
    }, false);
</script>
@endpush