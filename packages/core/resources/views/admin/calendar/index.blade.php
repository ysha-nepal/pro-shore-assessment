<div class="calendar-data-container">
    <div class="calendar-controller " >
        <div class="row align-items-center mb-3">
            <div class="col-lg-4">
                <h4 class="m-0 current-date">
                    <i class="bi bi-calendar me-2"></i> आज
                </h4>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-2">
                        <button class="btn btn-success prev-month">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                    </div>
                    <div class="col-lg-4">
                        {{Form::Select('year',$years ?? [],$data['bsYear'],[
                  'class' => 'form-control year-selector'
              ])}}
                    </div>
                    <div class="col-lg-4">
                        {{Form::Select('month',config('core.nepali-date.bsMonths'),$data['bsMonth'] - 1,[
                'class' => 'form-control month-selector'
            ])}}
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-success next-month">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-end">
                <h4 class="m-0">{{ $data['formattedDate']['y'] . " " . $data['formattedDate']['M'] }}  | {{ implode('/',$adMonths) }} {{ implode('/',$adYears) }}</h4>
            </div>

        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach(config('core.nepali-date.bsDays') as $day)
                <th>{{ $day }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($results as $days)
            <tr>
                @foreach($days as $day)
                    <td
                        data-day-name="{{ config('core.nepali-date.bsDays.' . $loop->index) }}"
                        data-month-name="{{ config('core.nepali-date.bsMonths.' . $day['month'] - 1) }}"
                        data-ad-date="{{ $day['adDate']->format('Y-m-d')  }}"
                        data-bs-date="{{ $day['bsDate'] }}"
                        @class([
                            'current-month' => $day['currentMonth'],
                            'other-month' => !$day['currentMonth'],
                            'weekend' => $loop->last,
                            'today' => $data['bsDate'] === $day['bsDate'],
                            'calendar-days' => count($day['events']) > 0
                    ])>
                        <p class="nep-date">  {!! nepali_number_span($day['bsDate']) !!}</p>
                        <p class="eng-date">{{ $day['adDate']->format('d') }}</p>
                        @if(count($day['events']) > 0)
                            <p class="events badge bg-success">
                                {{ count($day['events']) }}
                            </p>
                        @endif
                        @if(count($day['events']) > 0)
                            <div class="calendar-event-container event-trans">
                                <div class="bs-date-container">
                                    {{ config('core.nepali-date.bsMonths.' . $day['month'] - 1) }} {{ $day['bsDate'] }},
                                    {{$data['bsYear']}}, {{ config('core.nepali-date.bsDays.' . $loop->index) }}
                                    {{ $day['adDate']->format('Y-m-d')  }}
                                    <p class="calendar-event-close float-end"><i class="bi bi-x"></i></p>
                                </div>
                                <div class="color-container">
                                    @foreach($colors as $title => $color)
                                        <span style="{{ 'background-color:' . $color }}" class="badge rounded-pill">{{ $title }}</span>
                                    @endforeach
                                </div>
                                <div class="event-container">
                                    <ul>
                                        @foreach($day['events'] as $event)
                                            <li class="d-flex justify-content-between">
                                                <div class="event-detail">
                                                    @if($event['url'])
                                                        <a style="{{ $event['color'] ? 'color:' . $event['color'] .';' : '#eee' }}" href="{{ $event['url'] }}"><i class="bi bi-arrow-right me-2"></i>{{ $event['title'] }}</a>
                                                    @else
                                                        <i class="bi bi-arrow-right me-2"></i>{{ $event['title'] }}
                                                    @endif
                                                </div>
                                                <div class="event-dates">
                                                    <div class="badge bg-success">
                                                        {!! nepali_number_span($event['bs_start_date']) !!}
                                                    </div>
                                                    <div class="badge bg-danger">
                                                        {!! nepali_number_span($event['bs_end_date']) !!}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


