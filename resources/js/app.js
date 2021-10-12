/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from "vue";

require('./bootstrap');
import moment from 'moment'
axios.get('/api/user')
    .then(response => {
        new Vue({
            data(){
                return {
                    user: response.data,
                    moment,
                    now: 0,
                    store: {
                        state: {
                            user: {},
                            loading: false,
                        },
                        mutations: {

                            handleLoading(state, data){
                                state.loading = data
                            }
                        },
                        dispatch(mutation, data = {}){ //$root.store.dispatch
                            this.mutations[mutation](this.state, data)
                        }
                    }
                }
            },
            mounted(){
                //axios.put("/api/agents/" + this.user.id, {date_started: new Date()})
                var vm = this
                var x = setInterval(function () {
                    vm.now = new Date().getTime()
                }, 1000);
            },
            render: h => h(require('./components/App.vue').default)
        }).$mount('#app')
    });


