<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h2>Find Doctors</h2>
            </div>
            <div class="card-body">
                <datepicker class="my-datepicker" calendar-class="my-datepicker_calendar" :format="customDate" :inline=true :disabledDates="disabledDates" v-model="time" />
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2>Available Doctors</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Specialization</th>
                            <th>Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(d, index) in doctors" :key="d.id">
                            <td>{{ index+1 }}</td>
                            <td>
                                <img :src="`/images/${d.doctor.image}`" width="80" alt="">
                            </td>
                            <td>{{ d.doctor.name }}</td>
                            <td>{{ d.doctor.department }}</td>
                            <td>
                                <a :href="`/new-appointment/${d.user_id}/${d.date}`">
                                    <button class="btn btn-success">Book Appointment</button>
                                </a>
                            </td>
                        </tr>
                        <td v-if="doctors.length == 0">
                            <h4>No Doctors Available for {{ this.time }}</h4>
                        </td>
                    </tbody>
                </table>

                <div class="text-center">
                    <pulse-loader :loading="loading"></pulse-loader>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import datepicker from 'vuejs-datepicker';
import moment from 'moment';
import PulseLoader from 'vue-spinner/src/PulseLoader';

export default {
    components: {
        datepicker,
        PulseLoader
    },
    mounted() {
        this.availableDoctors();
    },
    data() {
        return {
            time: '',
            doctors: [],
            loading: false,
            disabledDates: {
                to: new Date(Date.now() - 86400000)
            }
        }
    },
    methods: {
        customDate(date) {
            this.time = moment(date).format('YYYY-MM-DD');
            this.findDoctors();
        },
        availableDoctors() {
            this.loading = true;
            axios.get(`/api/available/doctors`)
                .then(res => {
                    this.doctors = res.data;
                });
            this.loading = false;
        },
        findDoctors() {
            this.loading = true;
            axios.post(`/api/find/doctors`, { date: this.time })
                .then(res => {
                    setTimeout(() => {
                        this.doctors = res.data;
                        this.loading = false;
                    }, 1000);
                })
                .catch(err => alert(err));
        }
    }
}
</script>

<style scoped>
    .my-datepicker >>> .my-datepicker_calendar {
        width: 100%;
        height: 330px;
    }
</style>