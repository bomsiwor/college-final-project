@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Percobaan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Percobaan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Percobaan form</h5>
                    <form action="{{ route('tool.logs') }}" method="post">
                        {{-- Nama alat --}}
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="inventory_id" value="a7466d02-3f6e-46a1-8e09-0edc50114db8">
                        <div class="row mb-3">
                            <label for="purpose" class="col-md-4 col-lg-3 col-form-label">Tujuan</label>
                            <div class="col-md-8 col-lg-5">
                                <input name="purpose" type="text" class="form-control " id="purpose">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="start_time" class="col-md-4 col-lg-3 col-form-label">Jam mulai</label>
                            <div class="col-md-8 col-lg-5">
                                <input name="start_time" type="time" class="form-control " id="start_time">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="end_time" class="col-md-4 col-lg-3 col-form-label">Jam selesai</label>
                            <div class="col-md-8 col-lg-5">
                                <input name="end_time" type="time" class="form-control " id="end_time">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="log_date" class="col-md-4 col-lg-3 col-form-label">Tanggal</label>
                            <div class="col-md-8 col-lg-5">
                                <input name="log_date" type="date" class="form-control " id="log_date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="end_condition" class="col-md-4 col-lg-3 col-form-label">Kondisi</label>
                            <div class="col-md-8 col-lg-5">
                                <input name="end_condition" type="text" class="form-control " id="end_condition">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hv" class="col-md-4 col-lg-3 col-form-label">HV</label>
                            <div class="col-md-8 col-lg-5">
                                <input name="additional[hv]" type="number" class="form-control " id="hv">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="amp" class="col-md-4 col-lg-3 col-form-label">amp</label>
                            <div class="col-md-8 col-lg-5">
                                <input name="additional[amp]" type="number" class="form-control " id="amp">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="adc" class="col-md-4 col-lg-3 col-form-label">adc</label>
                            <div class="col-md-8 col-lg-5">
                                <input name="additional[adc]" type="number" class="form-control " id="adc">
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary mx-1">Simpan alat</button>
                    </form>
                </div>
            </div>
        </section>


    </main><!-- End #main -->
@endsection
