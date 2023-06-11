
<!DOCTYPE html>

<!--[if lt IE 7]>
<html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <title>InvoicePlane Demo (1.5.0)</title>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="NOINDEX,NOFOLLOW">

<link rel="icon" type="image/png" href="https://demo.invoiceplane.com/assets/core/img/favicon.png">

<link rel="stylesheet" href="https://demo.invoiceplane.com/assets/invoiceplane/css/style.css?v=1.5.9">
<link rel="stylesheet" href="https://demo.invoiceplane.com/assets/core/css/custom.css?v=1.5.9">


<!--[if lt IE 9]>
<script src="https://demo.invoiceplane.com/assets/core/js/legacy.min.js?v=1.5.9"></script>
<![endif]-->

<script src="https://demo.invoiceplane.com/assets/core/js/dependencies.min.js?v=1.5.9"></script>

<script>
    Dropzone.autoDiscover = false;

    
    $(function () {
        $('.nav-tabs').tab();
        $('.tip').tooltip();

        $('body').on('focus', '.datepicker', function () {
            $(this).datepicker({
                autoclose: true,
                format: 'mm/dd/yyyy',
                language: 'en',
                weekStart: '0',
                todayBtn: "linked"
            });
        });

        $(document).on('click', '.create-invoice', function () {
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/invoices/ajax/modal_create_invoice");
        });

        $(document).on('click', '.create-quote', function () {
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/quotes/ajax/modal_create_quote");
        });

        $(document).on('click', '#btn_quote_to_invoice', function () {
            var quote_id = $(this).data('quote-id');
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/quotes/ajax/modal_quote_to_invoice/" + quote_id);
        });

        $(document).on('click', '#btn_copy_invoice', function () {
            var invoice_id = $(this).data('invoice-id');
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/invoices/ajax/modal_copy_invoice", {invoice_id: invoice_id});
        });

        $(document).on('click', '#btn_create_credit', function () {
            var invoice_id = $(this).data('invoice-id');
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/invoices/ajax/modal_create_credit", {invoice_id: invoice_id});
        });

        $(document).on('click', '#btn_copy_quote', function () {
            var quote_id = $(this).data('quote-id');
            var client_id = $(this).data('client-id');
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/quotes/ajax/modal_copy_quote", {
                quote_id: quote_id,
                client_id: client_id
            });
        });

        $(document).on('click', '.client-create-invoice', function () {
            var client_id = $(this).data('client-id');
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/invoices/ajax/modal_create_invoice", {client_id: client_id});
        });

        $(document).on('click', '.client-create-quote', function () {
            var client_id = $(this).data('client-id');
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/quotes/ajax/modal_create_quote", {client_id: client_id});
        });

        $(document).on('click', '.invoice-add-payment', function () {
            invoice_id = $(this).data('invoice-id');
            invoice_balance = $(this).data('invoice-balance');
            invoice_payment_method = $(this).data('invoice-payment-method');
            $('#modal-placeholder').load("https://demo.invoiceplane.com/index.php/payments/ajax/modal_add_payment", {
                invoice_id: invoice_id,
                invoice_balance: invoice_balance,
                invoice_payment_method: invoice_payment_method
            });
        });

    });
</script>
</head>
<body class="hidden-sidebar">

<noscript>
    <div class="alert alert-danger no-margin">Please enable Javascript to use InvoicePlane</div>
</noscript>

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ip-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                Menu &nbsp; <i class="fa fa-bars"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="ip-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="https://demo.invoiceplane.com/index.php/dashboard" class="hidden-md">Dashboard</a>                    <a href="https://demo.invoiceplane.com/index.php/dashboard" class="visible-md-inline-block"><i class="fa fa-dashboard"></i></a>                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Clients</span>
                        <i class="visible-md-inline fa fa-users"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://demo.invoiceplane.com/index.php/clients/form">Add Client</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/clients/index">View Clients</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Quotes</span>
                        <i class="visible-md-inline fa fa-file"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="create-quote">Create Quote</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/quotes/index">View Quotes</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Invoices</span>
                        <i class="visible-md-inline fa fa-file-text"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="create-invoice">Create Invoice</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/invoices/index">View Invoices</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/invoices/recurring/index">View Recurring Invoices</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Payments</span>
                        <i class="visible-md-inline fa fa-credit-card"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://demo.invoiceplane.com/index.php/payments/form">Enter Payment</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/payments/index">View Payments</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/payments/online_logs">View Online Payment Logs</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Products</span>
                        <i class="visible-md-inline fa fa-database"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://demo.invoiceplane.com/index.php/products/form">Create product</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/products/index">View products</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/families/index">Product families</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/units/index">Product Units</a></li>
                    </ul>
                </li>

                <li class="dropdown 1">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Tasks</span>
                        <i class="visible-md-inline fa fa-check-square-o"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://demo.invoiceplane.com/index.php/tasks/form">Create task</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/tasks/index">Show tasks</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/projects/index">Projects</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Reports</span>
                        <i class="visible-md-inline fa fa-bar-chart"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://demo.invoiceplane.com/index.php/reports/invoice_aging">Invoice Aging</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/reports/payment_history">Payment History</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/reports/sales_by_client">Sales by Client</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/reports/sales_by_year">Sales by Date</a></li>
                    </ul>
                </li>

            </ul>

            
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="http://docs.invoiceplane.com/" target="_blank"
                       class="tip icon" title="Documentation"
                       data-placement="bottom">
                        <i class="fa fa-question-circle"></i>
                        <span class="visible-xs">&nbsp;Documentation</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="#" class="tip icon dropdown-toggle" data-toggle="dropdown"
                       title="Settings"
                       data-placement="bottom">
                        <i class="fa fa-cogs"></i>
                        <span class="visible-xs">&nbsp;Settings</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://demo.invoiceplane.com/index.php/custom_fields/index">Custom Fields</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/email_templates/index">Email Templates</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/invoice_groups/index">Invoice Groups</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/invoices/archive">Invoice Archive</a></li>
                        <!-- // temporarily disabled
                        <li><a href="https://demo.invoiceplane.com/index.php/item_lookups/index">Item Lookups</a></li>
                        -->
                        <li><a href="https://demo.invoiceplane.com/index.php/payment_methods/index">Payment Methods</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/tax_rates/index">Tax Rates</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/users/index">User Accounts</a></li>
                        <li class="divider hidden-xs hidden-sm"></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/settings">System Settings</a></li>
                        <li><a href="https://demo.invoiceplane.com/index.php/import">Import Data</a></li>
                    </ul>
                </li>
                <li>
                    <a href="https://demo.invoiceplane.com/index.php/users/form/1"
                       class="tip icon" data-placement="bottom"
                       title="InvoicePlane Demo">
                        <i class="fa fa-user"></i>
                        <span class="visible-xs">&nbsp;InvoicePlane Demo</span>
                    </a>
                </li>
                <li>
                    <a href="https://demo.invoiceplane.com/index.php/sessions/logout"
                       class="tip icon logout" data-placement="bottom"
                       title="Logout">
                        <i class="fa fa-power-off"></i>
                        <span class="visible-xs">&nbsp;Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="main-area">
        <div id="main-content">
        <div id="content">
    
    <div class="row ">
        <div class="col-xs-12">

            <div id="panel-quick-actions" class="panel panel-default quick-actions">

                <div class="panel-heading">
                    <b>Quick Actions</b>
                </div>

                <div class="btn-group btn-group-justified no-margin">
                    <a href="https://demo.invoiceplane.com/index.php/clients/form" class="btn btn-default">
                        <i class="fa fa-user fa-margin"></i>
                        <span class="hidden-xs">Add Client</span>
                    </a>
                    <a href="javascript:void(0)" class="create-quote btn btn-default">
                        <i class="fa fa-file fa-margin"></i>
                        <span class="hidden-xs">Create Quote</span>
                    </a>
                    <a href="javascript:void(0)" class="create-invoice btn btn-default">
                        <i class="fa fa-file-text fa-margin"></i>
                        <span class="hidden-xs">Create Invoice</span>
                    </a>
                    <a href="https://demo.invoiceplane.com/index.php/payments/form" class="btn btn-default">
                        <i class="fa fa-credit-card fa-margin"></i>
                        <span class="hidden-xs">Enter Payment</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">

            <div id="panel-quote-overview" class="panel panel-default overview">

                <div class="panel-heading">
                    <b><i class="fa fa-bar-chart fa-margin"></i> Quote Overview</b>
                    <span class="pull-right text-muted">This Quarter</span>
                </div>

                <table class="table table-bordered table-condensed no-margin">
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/quotes/status/draft">
                                    Draft                                </a>
                            </td>
                            <td class="amount">
                        <span class="draft">
                            $0.00                        </span>
                            </td>
                        </tr>
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/quotes/status/sent">
                                    Sent                                </a>
                            </td>
                            <td class="amount">
                        <span class="sent">
                            $0.00                        </span>
                            </td>
                        </tr>
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/quotes/status/viewed">
                                    Viewed                                </a>
                            </td>
                            <td class="amount">
                        <span class="viewed">
                            $0.00                        </span>
                            </td>
                        </tr>
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/quotes/status/approved">
                                    Approved                                </a>
                            </td>
                            <td class="amount">
                        <span class="approved">
                            $0.00                        </span>
                            </td>
                        </tr>
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/quotes/status/rejected">
                                    Rejected                                </a>
                            </td>
                            <td class="amount">
                        <span class="rejected">
                            $0.00                        </span>
                            </td>
                        </tr>
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/quotes/status/canceled">
                                    Canceled                                </a>
                            </td>
                            <td class="amount">
                        <span class="canceled">
                            $0.00                        </span>
                            </td>
                        </tr>
                                    </table>
            </div>

        </div>
        <div class="col-xs-12 col-md-6">

            <div id="panel-invoice-overview" class="panel panel-default overview">

                <div class="panel-heading">
                    <b><i class="fa fa-bar-chart fa-margin"></i> Invoice Overview</b>
                    <span class="pull-right text-muted">This Quarter</span>
                </div>

                <table class="table table-bordered table-condensed no-margin">
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/invoices/status/draft">
                                    Draft                                </a>
                            </td>
                            <td class="amount">
                        <span class="draft">
                            $61,218.40                        </span>
                            </td>
                        </tr>
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/invoices/status/sent">
                                    Sent                                </a>
                            </td>
                            <td class="amount">
                        <span class="sent">
                            $0.00                        </span>
                            </td>
                        </tr>
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/invoices/status/viewed">
                                    Viewed                                </a>
                            </td>
                            <td class="amount">
                        <span class="viewed">
                            $0.00                        </span>
                            </td>
                        </tr>
                                            <tr>
                            <td>
                                <a href="https://demo.invoiceplane.com/index.php/invoices/status/paid">
                                    Paid                                </a>
                            </td>
                            <td class="amount">
                        <span class="paid">
                            $0.00                        </span>
                            </td>
                        </tr>
                                    </table>
            </div>


                            <div class="panel panel-danger panel-heading">
                    <a href="https://demo.invoiceplane.com/index.php/invoices/status/overdue" class="text-danger"><i class="fa fa-external-link"></i> Overdue Invoices</a>                    <span class="pull-right text-danger">
                        $54,000.00                    </span>
                </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">

            <div id="panel-recent-quotes" class="panel panel-default">

                <div class="panel-heading">
                    <b><i class="fa fa-history fa-margin"></i> Recent Quotes</b>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th style="min-width: 15%;">Date</th>
                            <th style="min-width: 15%;">Quote</th>
                            <th style="min-width: 35%;">Client</th>
                            <th style="text-align: right;">Balance</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                                                    <tr>
                                <td>
                                <span class="label
                                draft">
                                    Draft                                </span>
                                </td>
                                <td>
                                    08/02/2018                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/24">QUO-18-0024</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/11">Hempstead Pizza One</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/24"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                draft">
                                    Draft                                </span>
                                </td>
                                <td>
                                    04/07/2018                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/23">QUO-18-0023</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/10">Merrick Roads, Ltd.</a>                                </td>
                                <td class="amount">
                                    $187.20                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/23"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    04/06/2018                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/22">QUO-18-0022</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/7">Jasveer Arwehan</a>                                </td>
                                <td class="amount">
                                    $491.13                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/22"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                sent">
                                    Sent                                </span>
                                </td>
                                <td>
                                    03/28/2018                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/21">QUO-18-0021</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/8">Dale Gardner</a>                                </td>
                                <td class="amount">
                                    $27,242.80                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/21"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                viewed">
                                    Viewed                                </span>
                                </td>
                                <td>
                                    04/06/2018                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/19">QUO-18-0019</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/6">Julia Steward</a>                                </td>
                                <td class="amount">
                                    $31,018.00                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/19"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    03/02/2018                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/18">QUO-17-0018</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/13">Lorraine Gibson</a>                                </td>
                                <td class="amount">
                                    $540.00                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/18"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    08/16/2017                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/17">QUO-17-0017</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/2">Stockton Cabs</a>                                </td>
                                <td class="amount">
                                    $404,460.00                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/17"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                canceled">
                                    Canceled                                </span>
                                </td>
                                <td>
                                    04/06/2017                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/15">QUO-17-0015</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/6">Julia Steward</a>                                </td>
                                <td class="amount">
                                    $31,018.00                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/15"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    04/10/2017                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/14">QUO-17-0014</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/5">Flint Motors, Ltd.</a>                                </td>
                                <td class="amount">
                                    $1,498.56                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/14"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                rejected">
                                    Rejected                                </span>
                                </td>
                                <td>
                                    04/06/2017                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/view/13">QUO-17-0013</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/6">Julia Steward</a>                                </td>
                                <td class="amount">
                                    $31,018.00                                </td>
                                <td style="text-align: center;">
                                    <a href="https://demo.invoiceplane.com/index.php/quotes/generate_pdf/13"
                                       title="Download PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                <tr>
                            <td colspan="6" class="text-right small">
                                <a href="https://demo.invoiceplane.com/index.php/quotes/status/all">View All</a>                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-6">

            <div id="panel-recent-invoices" class="panel panel-default">

                <div class="panel-heading">
                    <b><i class="fa fa-history fa-margin"></i> Recent Invoices</b>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th style="min-width: 15%;">Due Date</th>
                            <th style="min-width: 15%;">Invoice</th>
                            <th style="min-width: 35%;">Client</th>
                            <th style="text-align: right;">Balance</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/01/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/37">INV-18-0037</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/4">Waterford Reparis Inc.</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/37"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/01/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/36">INV-18-0036</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/12">Alvin Lewis</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/36"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/29/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/35">INV-18-0035</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/15">sandeep gupta</a>                                </td>
                                <td class="amount">
                                    $5,500.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/35"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/22/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/34">INV-18-0034</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/15">sandeep gupta</a>                                </td>
                                <td class="amount">
                                    $7,500.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/34"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/01/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/33">INV-18-0033</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/2">Stockton Cabs</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/33"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/01/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/32">INV-18-0032</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/2">Stockton Cabs</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/32"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/01/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/31">INV-18-0031</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/2">Stockton Cabs</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/31"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/01/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/30">INV-18-0030</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/6">Julia Steward</a>                                </td>
                                <td class="amount">
                                    $10.40                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/30"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/01/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/29">INV-18-0029</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/4">Waterford Reparis Inc.</a>                                </td>
                                <td class="amount">
                                    $24,104.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/29"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label draft">
                                        Draft                                    </span>
                                </td>
                                <td>
                                    <span class="">
                                        09/01/2018                                    </span>
                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/invoices/view/28">INV-18-0028</a>                                </td>
                                <td>
                                    <a href="https://demo.invoiceplane.com/index.php/clients/view/6">Julia Steward</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="https://demo.invoiceplane.com/index.php/invoices/generate_pdf/28"
                                           title="Download PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                <tr>
                            <td colspan="6" class="text-right small">
                                <a href="https://demo.invoiceplane.com/index.php/invoices/status/all">View All</a>                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

            <div class="row">
            <div class="col-xs-12 col-md-6">

                <div id="panel-projects" class="panel panel-default">

                    <div class="panel-heading">
                        <b><i class="fa fa-list fa-margin"></i> Projects</b>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed no-margin">
                            <thead>
                            <tr>
                                <th>Project name</th>
                                <th>Client Name</th>
                            </tr>
                            </thead>

                            <tbody>
                                                            <tr>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/projects/view/1">Stockton cab replacement</a>                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/clients/view/2">Stockton Cabs</a>                                    </td>
                                </tr>
                                                        </tbody>

                        </table>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-md-6">

                <div id="panel-recent-invoices" class="panel panel-default">

                    <div class="panel-heading">
                        <b><i class="fa fa-check-square-o fa-margin"></i> Tasks</b>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-condensed no-margin">

                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Task name</th>
                                <th>Finish date</th>
                                <th>Project</th>
                            </tr>
                            </thead>

                            <tbody>
                                                            <tr>
                                    <td>
                                    <span class="label sent">
                                        Complete                                    </span>
                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/tasks/form/4">lasdkjflakdsf</a>                                    </td>
                                    <td>
                                    <span class="">
                                        08/02/2018                                    </span>
                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/projects/view/1">Stockton cab replacement</a>                                    </td>
                                </tr>
                                                            <tr>
                                    <td>
                                    <span class="label paid">
                                        Invoiced                                    </span>
                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/tasks/form/3">Replace cars #034 - #041</a>                                    </td>
                                    <td>
                                    <span class="text-danger">
                                        06/01/2018                                    </span>
                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/projects/view/1">Stockton cab replacement</a>                                    </td>
                                </tr>
                                                            <tr>
                                    <td>
                                    <span class="label paid">
                                        Invoiced                                    </span>
                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/tasks/form/2">Replace cars #021 - #033</a>                                    </td>
                                    <td>
                                    <span class="text-danger">
                                        06/30/2017                                    </span>
                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/projects/view/1">Stockton cab replacement</a>                                    </td>
                                </tr>
                                                            <tr>
                                    <td>
                                    <span class="label paid">
                                        Invoiced                                    </span>
                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/tasks/form/1">Replace cars #005 - #020</a>                                    </td>
                                    <td>
                                    <span class="text-danger">
                                        03/31/2017                                    </span>
                                    </td>
                                    <td>
                                        <a href="https://demo.invoiceplane.com/index.php/projects/view/1">Stockton cab replacement</a>                                    </td>
                                </tr>
                                                        </tbody>

                        </table>
                    </div>

                </div>

            </div>
        </div>
    
</div>
    </div>

</div>

<div id="modal-placeholder"></div>

<div id="fullpage-loader" style="display: none">
    <div class="loader-content">
        <i id="loader-icon" class="fa fa-cog fa-spin"></i>
        <div id="loader-error" style="display: none">
            It seems that the application stuck because of an error.<br/>
            <a href="https://wiki.invoiceplane.com/en/1.0/general/faq"
               class="btn btn-primary btn-sm" target="_blank">
                <i class="fa fa-support"></i> Get Help            </a>
        </div>
    </div>
    <div class="text-right">
        <button type="button" class="fullpage-loader-close btn btn-link tip" aria-label="Close"
                title="Close" data-placement="left">
            <span aria-hidden="true"><i class="fa fa-close"></i></span>
        </button>
    </div>
</div>

<script defer src="https://demo.invoiceplane.com/assets/core/js/scripts.min.js"></script>

</body>
</html>
