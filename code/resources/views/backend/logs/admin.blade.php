@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                             <div class="section">
                                Log Management
                            </div>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Admin Log</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment">
                            <h5 class="ui header">
                                Admin Log
                            </h5>
                            <table id="list-table" class="ui compact striped celled table">
                                <thead>
                                    <tr>
                                        <th><i class="hashtag icon"></i></th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                        <th>User</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($log as $index => $l)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $l->admin->firstname }}</td>
                                            <td>{{ $l->admin->role['name'] }}</td>
                                            <td>{{ $l->status['name'] }}</td>
                                            <td>{{ $l->user['firstname'] }}</td>
                                            <td>{{ $l->description }}</td>
                                            <td>{{ date('d M Y', strtotime($l->created_at)) }}</td>
                                            <td>{{ date('H:i:s', strtotime($l->created_at)) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="center aligned" colspan="8">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="8">
                                            <a class="ui left floated tiny blue button" href="{{ route('backend.logs.print', 3) }}">
                                                <i class="print icon"></i>Print
                                            </a>

                                            <!-- Pagination -->
                                            @if ($log->total() > 0)
                                                <div class="ui right floated mini pagination menu">
                                                    @php ($link_limit = 7)
                                                    <a class="item {{ $log->currentPage() == 1 ? 'disabled' : '' }}" href="{{ $log->url(1) }}">
                                                        <i class="left chevron icon"></i>
                                                    </a>
                                                    <a class="item {{ $log->currentPage() == $log->lastPage() ? 'disabled' : '' }}" href="{{ $log->previousPageUrl() }}">
                                                        Prev
                                                    </a>
                                                    @for ($i = 1; $i <= $log->lastPage(); $i++)
                                                        <?php
                                                            $half = floor($link_limit/2);
                                                            $from = $log->currentPage() - $half;
                                                            $to = $log->currentPage() + $half;
                                                            if ($log->currentPage() < $half)
                                                            {
                                                                $to += $half - $log->currentPage();
                                                            }
                                                            if ($log->lastPage() - $log->currentPage() < $half)
                                                            {
                                                                $from -= $half - ($log->lastPage() - $log->currentPage()) - 1;
                                                            }
                                                        ?>
                                                        @if ($from < $i && $i < $to)
                                                            <a class="item {{ $log->currentPage() == $i ? 'active' : '' }}" href="{{ $log->url($i) }}">
                                                                {{ $i }}
                                                            </a>
                                                        @endif
                                                    @endfor
                                                    <a class="item {{ $log->currentPage() == $log->lastPage() ? 'disabled' : '' }}" href="{{ $log->nextPageUrl() }}">
                                                        Next
                                                    </a>
                                                    <a class="item {{ $log->currentPage() == $log->lastPage() ? 'disabled' : '' }}" href="{{ $log->url($log->lastPage()) }}">
                                                        <i class="right chevron icon"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- End Grid -->
        </div> <!-- End Container -->
    </div> <!-- End Pusher -->

@endsection