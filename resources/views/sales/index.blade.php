@extends('layouts.app')

@section('title', "Lista | ".__('section.sale'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading([
          'route' => route('dashboard'),
          'routeTitle' => __('section.sales'),
          'title' => __('section.sale'),
        ])
          <div class="hidden-xs col-sm-3 col-md-3 col-lg-2 pull-right text-right">
            @salesButtonCreate
            @endsalesButtonCreate
          </div>
        @endpanelHeading

        <div class="panel-body">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          @if (count($sales) < 1)
            @blankSlate([
              'message' => "No hay compra ventas registradas. ¿Porqué no creas una nueva?"
            ])
              @salesButtonCreate
              @endsalesButtonCreate
            @endblankSlate
          @else
            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
              <table class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                  <tr>
                    @include('sales.partials.table-header')
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    @include('sales.partials.table-footer')
                  </tr>
                </tfoot>

                <tbody>
                  @each('sales.partials.items', $sales, 'sale')
                </tbody>
              </table>
            </div>
          @endif
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-12 col-sm-12 hidden-md hidden-lg text-center">
              @salesButtonCreate
              @endsalesButtonCreate
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
