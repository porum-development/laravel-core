@extends('devplace::layouts.backend')

@section('content')
    <!-- Dash Buttons -->
    <div class="bg-body-dark">
        <div class="content">
            <div class="row">
                @component('devplace::components.buttons.big', ['href' => route('admin.user.index', [$locale]), 'icon' => 'fa-users'])
                    {{ __('Users') }}
                @endcomponent
                @component('devplace::components.buttons.big', ['href' => route('admin.user.index', [$locale]), 'icon' => 'fa-lock'])
                    {{ __('Profiles') }}
                @endcomponent
                @component('devplace::components.buttons.big', ['href' => route('admin.user.create', [$locale]), 'icon' => 'fa-plus-square-o'])
                    {{ __('New User') }}
                @endcomponent
                @component('devplace::components.buttons.big', ['href' => route('dashboard', [$locale]), 'icon' => 'fa-plus-square-o'])
                    {{ __('New Profile') }}
                @endcomponent
                @component('devplace::components.buttons.big', ['href' => route('dashboard', [$locale]), 'icon' => 'fa-warning'])
                    {{ __('Notifications') }}
                @endcomponent
                @component('devplace::components.buttons.big', ['href' => route('dashboard', [$locale]), 'icon' => 'fa-wrench'])
                    {{ __('Settings') }}
                @endcomponent
            </div>
        </div>
    </div>
    <!-- END Dash Buttons -->



    <!-- Page Content -->
    <div class="content">
        <!-- Info Blocks -->
        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-bag fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000"
                             data-to="1500">1500
                        </div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Sales</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600">$<span data-toggle="countTo" data-speed="1000" data-to="780"
                                                                   class="js-count-to-enabled">780</span></div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Earnings</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-envelope-open fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000"
                             data-to="15">15
                        </div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Messages</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-users fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000"
                             data-to="4252">4252
                        </div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Online</div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Info Blocks -->

        <!-- Charts -->
        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Sales
                            <small>This week</small>
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div class="chartjs-size-monitor"
                                 style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                     style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                     style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <canvas class="js-chartjs-dashboard-lines chartjs-render-monitor" width="1122" height="560"
                                    style="display: block; height: 280px; width: 561px;"></canvas>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row items-push">
                            <div class="col-6 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">This Month</div>
                                <div class="font-size-h4 font-w600">720</div>
                                <div class="font-w600 text-success">
                                    <i class="fa fa-caret-up"></i> +16%
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">This Week</div>
                                <div class="font-size-h4 font-w600">160</div>
                                <div class="font-w600 text-danger">
                                    <i class="fa fa-caret-down"></i> -3%
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Average</div>
                                <div class="font-size-h4 font-w600">24.3</div>
                                <div class="font-w600 text-success">
                                    <i class="fa fa-caret-up"></i> +9%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Earnings
                            <small>This week</small>
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div class="chartjs-size-monitor"
                                 style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                     style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                     style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <canvas class="js-chartjs-dashboard-lines2 chartjs-render-monitor" width="1122" height="560"
                                    style="display: block; height: 280px; width: 561px;"></canvas>
                        </div>
                    </div>
                    <div class="block-content bg-white">
                        <div class="row items-push">
                            <div class="col-6 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">This Month</div>
                                <div class="font-size-h4 font-w600">$ 6,540</div>
                                <div class="font-w600 text-success">
                                    <i class="fa fa-caret-up"></i> +4%
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">This Week</div>
                                <div class="font-size-h4 font-w600">$ 1,525</div>
                                <div class="font-w600 text-danger">
                                    <i class="fa fa-caret-down"></i> -7%
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Balance</div>
                                <div class="font-size-h4 font-w600">$ 9,352</div>
                                <div class="font-w600 text-success">
                                    <i class="fa fa-caret-up"></i> +35%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Charts -->

        <!-- Table Infos -->
        <div class="row">
            <div class="col-lg-6">
                <div class="block block-fx-shadow">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Portfolio</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter">
                            <tbody>
                            <tr>
                                <td style="width: 32px;">
                                    <i class="fa fa-circle text-warning"></i>
                                </td>
                                <td style="width: 140px;">
                                    <strong>Bitcoin</strong>
                                </td>
                                <td class="d-none d-sm-table-cell" style="width: 160px;">
                                    <div class="progress mb-0" style="height: 10px;">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="47"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 47%"></div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    0.50 BTC
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-muted">
                                    ~ $7.000
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-circle text-info"></i>
                                </td>
                                <td>
                                    <strong>Ethereum</strong>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <div class="progress mb-0" style="height: 10px;">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="22"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 22%"></div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    3.00 ETH
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-muted">
                                    ~ $3.300
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-circle text-muted"></i>
                                </td>
                                <td>
                                    <strong>Litecoin</strong>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <div class="progress mb-0" style="height: 10px;">
                                        <div class="progress-bar bg-muted" role="progressbar" aria-valuenow="16"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 16%"></div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    10.00 LTC
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-muted">
                                    ~ $2.500
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-circle text-danger"></i>
                                </td>
                                <td>
                                    <strong>US Dollars</strong>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <div class="progress mb-0" style="height: 10px;">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="13"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 13%"></div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    2.000 USD
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-muted">
                                    $2.000
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-circle text-success"></i>
                                </td>
                                <td>
                                    <strong>Euros</strong>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <div class="progress mb-0" style="height: 10px;">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    0 EUR
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-muted">
                                    0€
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-circle text-elegance"></i>
                                </td>
                                <td>
                                    <strong>British Pounds</strong>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <div class="progress mb-0" style="height: 10px;">
                                        <div class="progress-bar bg-elegance" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    0 GBP
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-muted">
                                    £0
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-full bg-body-light text-muted text-center font-w600">
                        Total Balance ~ $14.800,00
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="block block-fx-shadow">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Recent Activity</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter">
                            <tbody>
                            <tr>
                                <td class="text-center" style="width: 50px;">
                                    JAN<br>10
                                </td>
                                <td>
                                    <strong>Bought Bitcoin</strong><br>
                                    <span class="text-muted">Using USD wallet</span>
                                </td>
                                <td class="text-right text-success font-w600">
                                    + 0.50 BTC
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-danger font-w600">
                                    - $6.500
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 50px;">
                                    JAN<br>05
                                </td>
                                <td>
                                    <strong>Bought Ethereum</strong><br>
                                    <span class="text-muted">Using USD wallet</span>
                                </td>
                                <td class="text-right text-success font-w600">
                                    + 3.00 ETH
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-danger font-w600">
                                    - $2.900
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 50px;">
                                    JAN<br>02
                                </td>
                                <td>
                                    <strong>Bought Litecoin</strong><br>
                                    <span class="text-muted">Using USD wallet</span>
                                </td>
                                <td class="text-right text-success font-w600">
                                    + 8.00 LTC
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-danger font-w600">
                                    - $1.800
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 50px;">
                                    JAN<br>01
                                </td>
                                <td>
                                    <strong>Bought Litecoin</strong><br>
                                    <span class="text-muted">Using USD wallet</span>
                                </td>
                                <td class="text-right text-success font-w600">
                                    + 2.00 LTC
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-danger font-w600">
                                    - $370
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-full bg-body-light text-center font-w600">
                        <a class="link-effect" href="be_pages_crypto_wallets.php">
                            View Your Wallets <i class="fa fa-angle-right ml-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Infos -->
    </div>
    <!-- END Page Content -->
@endsection
