@extends('layouts.app')

@section('title', 'Sistem Informasi Prestasi & Portal Profil Resmi SMA Negeri Unggulan')
@section('meta_description', 'Portal resmi profil SMA Negeri Unggulan dan sistem etalase portofolio capaian prestasi siswa tingkat kota, provinsi, nasional, hingga internasional secara terverifikasi.')

@section('content')
<div class="relative overflow-hidden">
    @include('landing.partials.hero')
    @include('landing.partials.sambutan')
    @include('landing.partials.visi-misi')
    @include('landing.partials.statistik')
    @include('landing.partials.hall-of-fame')
    @include('landing.partials.direktori')
    @include('landing.partials.berita-agenda')
    @include('landing.partials.fasilitas')
    @include('landing.partials.ppdb-kontak')
</div>

@include('landing.partials.modals')
@endsection

@push('scripts')
    @include('landing.partials.scripts')
@endpush
