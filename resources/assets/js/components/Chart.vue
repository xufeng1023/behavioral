<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="month" class="form-control" @change="getData" v-model="date" :value="date">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control" v-model="cat" @change="getData">
                            <option value="sleep">Sleep</option>
                            <option value="mood">Mood</option>
                            <option value="meal">Meal</option>
                        </select>
                    </div>
                </div>
            </div>
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                date: (new Date()).toJSON().slice(0, 7),
                cat: 'sleep',
                chart: null,
                datasets: [{
                    label: '',
                    data: [],
                    backgroundColor: 'transparent',
                    borderColor: '#4BC0C0'
                }],
                yLabels: {
                    sleep: ['Less than 6 hours','7 hours','8 hours','9 hours','More than 10 hours'],
                    mood: ['Bad','Not much','Good','Great','Excellent'],
                    meal: ['None','One meals','Two meals','Three meals','Too much']
                }
            }
        },
        methods: {
            resetData() {
                this.datasets[0].data = [];
            },
            getData() {
                this.resetData();
                axios.get('/questions?date='+this.date+'&cat='+this.cat)
                    .then(response => {
                        $.each(response.data, function(index, val) {
                            let key = (val.created_at.split('-'))[2] - 1;
                            this.datasets[0].data[key] = val['quest_'+this.cat]
                        }.bind(this))
                    }).then(() => this.setChart())
            },
            fillInitValue() {
                this.datasets[0].data = this.DaysAry().fill(null);
            },
            DaysAry() {
                return _.range(1, this.totalDays);
            },
            setChart() {
                if(this.chart) this.chart.destroy();
                this.datasets[0].label = this.cat
                const data = {
                    labels: this.DaysAry(),
                    datasets: this.datasets
                }
                const yLabelsAry = this.yLabels[this.cat];
                this.chart = new Chart(document.getElementById("myChart"), {
                    type: 'line',
                    data,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    stepSize: 1,
                                    max: 4,
                                    beginAtZero:true,
                                    callback: function(value, index, values) {
                                        return yLabelsAry[value];
                                    }
                                }
                            }]
                        }
                    }
                });
            }
        },
        computed: {
            totalDays() {
                let dateAry = this.date.split('-'); 
                return new Date(dateAry[0], dateAry[1], 0).getDate() + 1;
            }
        },
        mounted() {
            this.fillInitValue();
            this.getData();  
        }
    }
</script>
