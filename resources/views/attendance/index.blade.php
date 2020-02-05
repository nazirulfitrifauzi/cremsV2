@extends('layouts.app', ['title' => 'Attendance'])

@section('content')
    @include('users.partials.header', ['title' => 'Staff Attendances'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">

                        @php
                            //Columns must be a factor of 12 (1,2,3,4,6,12)
                            $numOfCols = 3;
                            $rowCount = 0;
                            $bootstrapColWidth = 12 / $numOfCols;
                        @endphp
                        
                        <div class="row">
                            <?php
                                foreach ($allStaff as $staff){

                                    $today = Carbon\Carbon::now()->toDateString();
                                    $check = App\Attendance::where('staff_id',$staff->id)->whereDate('login_at',$today)->exists();
                            ?>
                                
                                <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                                    @if ($check == true)
                                        <div class="card card-stats mb-4 mb-lg-0" style="background-color:lightgreen;">
                                    @else
                                        <div class="card card-stats mb-4 mb-lg-0" style="background-color:lightpink;">
                                    @endif
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">
                                                        @if ($check == true)
                                                            @php
                                                                $login_at = $staff->attendance()->whereDate('login_at',$today)->value('login_at');
                                                            @endphp
                                                            {{ $login_at->format('d M Y h:i A') }}
                                                        @else
                                                            ABSENT
                                                        @endif
                                                    </h5>
                                                    <span class="h2 font-weight-bold mb-0">{{ $staff->name }}</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="avatar avatar-sm rounded-circle">
                                                        <img alt="Image placeholder" src="{{ asset('storage') }}/Avatar/{{ $staff->user->avatar}}">
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span>
                                                    @php
                                                        $location = $staff->attendance()->whereDate('login_at',$today)->value('location');
                                                    @endphp
                                                    {{ $location }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                    $rowCount++;
                                    if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                }
                            ?>
                                </div>

                    </div> <!-- end card-body -->
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    @if (Session::has('success'))
    <script>
        demo.showNotification("bottom","right","done","{{ Session::get('success') }}","success");
    </script>
    @endif    
@endpush