<template>
    <div class="panel panel-default">
        <div class="panel-heading">Example Component</div>

        <div class="panel-body">
            <input type="month" class="form-control" v-model="date" :value="date"><hr>
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                date: null,
                sleep: [],
                mood: [],
                meal: []
            }
        },
        methods: {
            setToday() {
                const dateOjb = new Date();
                this.date = dateOjb.getFullYear() + '-' + ('0' + (dateOjb.getMonth() + 1)).slice(-2);
            },
            getData() {
                axios.get('/questions')
                    .then(response => {
                        $.each(response.data, function(index, val) {
                            let key = (val.created_at.split('-'))[2] - 1;
                            this.sleep[key] = val.quest_sleep
                            this.mood[key] = val.quest_day
                            this.meal[key] = val.quest_meal
                        }.bind(this))
                        console.log(this.sleep,this.mood,this.meal)
                    })
            },
            fillInitValue() {
                this.sleep = _.range(1, this.DaysPerMonth).fill(0);
                this.mood = _.range(1, this.DaysPerMonth).fill(0);
                this.meal = _.range(1, this.DaysPerMonth).fill(0);
            }
        },
        computed: {
            DaysPerMonth() {
                if( this.date === null ) return false;
                var dateAry = this.date.split('-'); 
                return new Date(dateAry[0], dateAry[1], 0).getDate() + 1; 
            }
        },
        mounted() {
            this.setToday();
            this.fillInitValue();
            this.getData();

            const data = {
                labels: _.range(1, this.DaysPerMonth),
                datasets: [{
                    label: 'sleep',
                    data: _.range(1, this.DaysPerMonth),
                }]
            }
            new Chart(document.getElementById("myChart"), {
                type: 'bar',
                data,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    }
</script>
