<div class="col-12">
    <div class="card">
        <div class="card-header pb-0 pt-2">
            <ul class="nav nav-tabs analytics-tab" id="myTab" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" id="analytics-tab-1"
                        data-bs-toggle="tab" data-bs-target="#analytics-tab-1-pane" type="button" role="tab"
                        aria-controls="analytics-tab-1-pane" aria-selected="true">Tổng quan</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="analytics-tab-2"
                        data-bs-toggle="tab" data-bs-target="#analytics-tab-2-pane" type="button" role="tab"
                        aria-controls="analytics-tab-2-pane" aria-selected="false" tabindex="-1">Doanh thu</button>
                </li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="analytics-tab-3"
                        data-bs-toggle="tab" data-bs-target="#analytics-tab-3-pane" type="button" role="tab"
                        aria-controls="analytics-tab-3-pane" aria-selected="false" tabindex="-1">Khách hàng</button>
                </li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="analytics-tab-4"
                        data-bs-toggle="tab" data-bs-target="#analytics-tab-4-pane" type="button" role="tab"
                        aria-controls="analytics-tab-4-pane" aria-selected="false" tabindex="-1">Giao dịch</button></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="analytics-tab-1-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-1" tabindex="0">
                            <canvas id="ordersChart" width="400" height="160"></canvas>
                        </div>
                        <div class="tab-pane fade" id="analytics-tab-2-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-2" tabindex="0">
                            <canvas id="ordersChart" width="400" height="150"></canvas>
                        </div>
                        <div class="tab-pane fade" id="analytics-tab-3-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-3" tabindex="0">
                            <canvas id="ordersChart" width="400" height="150"></canvas>
                        </div>
                        <div class="tab-pane fade" id="analytics-tab-4-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-4" tabindex="0">
                            <canvas id="ordersChart" width="400" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
