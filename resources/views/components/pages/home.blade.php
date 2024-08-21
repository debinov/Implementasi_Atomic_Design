<head>
    @section('judul', 'Dashboard')
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/img/avatar/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('template/plugins/bootstrap/css/bootstrap.min.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css') }}">
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('template/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('template/dist/js/demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctxPie = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Pending Properties', 'Sold Properties', 'Available Properties'],
                    datasets: [{
                        data: [1, 2, 3],
                        backgroundColor: ['#6c757d', '#d9534f', '#5cb85c'],
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Properties'
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.round(((currentValue / total) * 100) * 10) / 10;
                                return `${data.labels[tooltipItem.index]}: ${currentValue} (${percentage}%)`;
                            }
                        }
                    }
                }
            });
            var ctxBar = document.getElementById('myBarChart').getContext('2d');
            var myBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Accepted', 'Pending', 'Done', 'Rejected'],
                    datasets: [{
                        label: 'Schedules',
                        data: [1, 2, 3, 4],
                        backgroundColor: ['#5cb85c', '#f0ad4e', '#0275d8', '#d9534f']
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Schedules'
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</head>

<x-template.layout>
<body>
    @section('content')
    <main class="main users chart-page" id="skip-target">
        <x-organism.o-dashboard></x-organism.o-dashboard>
        <x-organism.o-dashboard-chart></x-organism.o-dashboard-chart>
    </main>
    @endsection
</body>
</x-template.layout>