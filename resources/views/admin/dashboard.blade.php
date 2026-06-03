
@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        {{-- filter tanggal --}}
        <form>
          <div class="row">
            <div class="col-12 col-lg-6">
              <div class="form-group">
                <label>Filter berdasarkan tahun:</label>
                <div class="input-group input-group-lg">
                  <select class="custom-select" name="year">
                    @php
                      $currentYear = date('Y');
                      $startYear = 2000;
                    @endphp
                    <option value=""></option>
                    @for ($year = $currentYear; $year >= $startYear; $year--)
                      <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                  </select>
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-default">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="form-group">
                <label>Filter berdasarkan bulan:</label>
                <div class="input-group input-group-lg">
                  <select class="custom-select" name="month">
                    @php
                      $months = [
                        1 => 'Januari', 
                        2 => 'Februari', 
                        3 => 'Maret', 
                        4 => 'April',
                        5 => 'Mei', 
                        6 => 'Juni', 
                        7 => 'Juli', 
                        8 => 'Agustus',
                        9 => 'September', 
                        10 => 'Oktober', 
                        11 => 'November', 
                        12 => 'Desember'
                      ];
                    @endphp
                    <option value=""></option>
                    @foreach ($months as $monthNumber => $item)
                      <option value="{{ $monthNumber }}" {{ request('month') == $monthNumber ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-default">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        {{-- end filter tanggal --}}
        
        <!-- 4 card -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $information->count() }}</h3>

                <p>Jumlah Permohonan Informasi</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-alt"></i>
              </div>
              <a href="/permohonan_informasi" class="small-box-footer">More info <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $submission->count() }}</h3>

                <p>Jumlah Pengajuan keberatan</p>
              </div>
              <div class="icon">
                <i class="fas fa-engine-warning"></i>
              </div>
              <a href="/pengajuan_keberatan" class="small-box-footer">More info <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $public->count() }}</h3>

                <p>Jumlah Informasi Publik</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-user"></i>
              </div>
              <a href="/informasi_publik" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $averageRating }}</h3>

                <p>Rata rata Rating</p>
              </div>
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
              <a href="/rating" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- end 4 card -->

        
        <div class="row">
          {{-- layout kiri --}}
          <div class="col-lg-6">
            {{-- grafik permohonan dan pengajuan --}}
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Permohonan dan Pengajuan {{ request('year') ?? date('Y') }}</h3>
                  {{-- <a href="javascript:void(0);">View Report</a> --}}
                </div>
              </div>
              <div class="card-body">

                <div class="position-relative mb-4">
                  <canvas id="grafikPermohonanPengajuan" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Permohonan
                  </span>

                  <span>
                    <i class="fas fa-square text-success"></i> Pengajuan
                  </span>
                </div>
              </div>
            </div>

            {{-- grafik permohonan informasi berdasarkan salinan --}}
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Persentase(%) Permohonan Informasi berdasarkan salinan {{ request('year') ?? date('Y') }}</h3>
                  {{-- <a href="javascript:void(0);">View Report</a> --}}
                </div>
              </div>
              <div class="card-body">
                <canvas id="permohonanSalinan"
                  style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>

            {{-- jumlah permohonan informasi berdasarkan kategori --}}
            <div>
              <!-- belum dibuka -->
              <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fas fa-lock-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Belum dibuka</span>
                  <span class="info-box-text">Permohonan <strong>{{ $sendPer }}</strong> - Pengajuan <strong>{{ $sendPeng }}</strong></span>
                </div>
                <!-- /.info-box-content -->
              </div>

              <!-- proses -->
              <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fad fa-spinner-third"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Proses</span>
                  <span class="info-box-text">Permohonan <strong>{{ $processPer }}</strong> - pengajuan <strong>{{ $processPeng }}</strong></span>
                </div>
                <!-- /.info-box-content -->
              </div>

              <!-- tolak -->
              <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fas fa-vote-nay"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Tolak</span>
                  <span class="info-box-text">Permohonan <strong>{{ $rejectPer }}</strong> - pengajuan <strong>{{ $rejectPeng }}</strong></span>
                </div>
                <!-- /.info-box-content -->
              </div>

              <!-- terima -->
              <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-vote-yea"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Terima</span>
                  <span class="info-box-text">Permohonan <strong>{{ $acceptPer }}</strong> - pengajuan <strong>{{ $acceptPeng }}</strong></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

          </div>

          {{-- layout kanan --}}
          <div class="col-lg-6">
            {{-- grafik informasi publik --}}
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Informasi Publik {{ request('year') ?? ''}}</h3>
                </div>
              </div>
              <div class="card-body">

                <div class="position-relative mb-4">
                  <canvas id="grafikInformasiPublik" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  @php
                    $months = ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6c757d', '#343a40',
                      '#f8f9fa', '#e83e8c', '#fd7e14'
                    ];
                  @endphp
                  @foreach ($referencesInformasi as $key => $item)
                    <span class="mr-2">
                      <i class="fas fa-square" style="color: {{ $months[$key] }}"></i> {{ $item->nama }}
                    </span>
                  @endforeach
                </div>
              </div>
            </div>

            {{-- ulasan terbaru --}}
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Ulasan Terbaru</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Bintang</th>
                      <th>ulasan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($newComments as $item)
                      <tr>
                        <td>{{ $item->pemohon->nama }}</td>
                        <td>
                          @for ($i = 0; $i < $item->star; $i++)
                            <i class="fas fa-star" style="color: #FFD43B;"></i>
                          @endfor
                        </td>
                        <td>{{ $item->comment }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('grafic')
  <script>
    $(function() {
      'use strict'

      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }

      var mode = 'index'
      var intersect = true

      // grafik permohonan dan pengajuan 
      var dataGrafik = {
        dataPermohonan: [
          @for ($i = 1; $i <= 12; $i++)
            '{{ $arrayPermohonanInformasiMonth[$i] }}',
          @endfor
        ],
        dataPengajuan: [
          @for ($i = 1; $i <= 12; $i++)
            '{{ $arrayPengajuanKeberatanMonth[$i] }}',
          @endfor
        ]
      }

      var $grafikPermohonanPengajuan = $('#grafikPermohonanPengajuan')
      var grafikPermohonanPengajuan = new Chart($grafikPermohonanPengajuan, {
        type: 'bar',
        data: {
          labels: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'],
          datasets: [{
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: dataGrafik.dataPermohonan
            },
            {
              backgroundColor: '#28a745',
              borderColor: '#28a745',
              data: dataGrafik.dataPengajuan
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              gridLines: {
                display: true,
                lineWidth: '4px',
                color: 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function(value) {
                  if (value >= 1000) {
                    value /= 1000
                    value += 'k'
                  }

                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      })
      // end grafik permohonan dan pengajuan 


      // grafik informasi publik 
      var dataGrafik = {
        labels: [
          @foreach ($referencesInformasi as $item)
            '{{ $item->nama }}',
          @endforeach
        ],
        values: [
          @for ($i = 0; $i < $referencesInformasiCount; $i++)
            '{{ $arrayInformasiPublik[$i] }}',
          @endfor
        ]
      };

      var $grafikInformasiPublik = $('#grafikInformasiPublik')
      var grafikInformasiPublik = new Chart($grafikInformasiPublik, {
        type: 'bar',
        data: {
          labels: dataGrafik.labels, // Menggunakan data dari variabel
          datasets: [{
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6c757d', '#343a40',
              '#f8f9fa', '#e83e8c', '#fd7e14'
            ],
            borderColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6c757d', '#343a40',
              '#f8f9fa', '#e83e8c', '#fd7e14'
            ],
            data: dataGrafik.values // Menggunakan data dari variabel
          }, ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              gridLines: {
                display: true,
                lineWidth: '4px',
                color: 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function(value) {
                  if (value >= 1000) {
                    value /= 1000
                    value += 'k'
                  }

                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      })
      // end grafik informasi publik


      // grafik pie salinan permohonan
      var donutData = {
        labels: [
          'Mengambil Langsung',
          'Email'
        ],
        datasets: [{
          data: [
            @for ($i = 0; $i < $referencesMedapatCount; $i++)
              '{{ $arrayPermohonanSalinan[$i] }}',
            @endfor
          ],
          backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6c757d', '#343a40',
              '#f8f9fa', '#e83e8c', '#fd7e14'
            ],
        }]
      }

      var pieChartCanvas = $('#permohonanSalinan').get(0).getContext('2d')
      var pieData = donutData;
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }

      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })

      // end grafik pie salinan permohonan

    })
  </script>
@endsection

