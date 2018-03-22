<template>
    <div class="container">
        <div class="navbar">
            <div class="navbar__brand">
                <router-link to="/">Recipe Box</router-link>
            </div>
            <ul class="navbar_list">
                <li class="navbar__item">
                    <router-link to="/login" v-if="!check">LOGIN</router-link>
                </li>
                <li class="navbar__item">
                    <router-link to="/register" v-if="!check">REGISTER</router-link>
                </li>
                <li class="navbar__item">
                    <router-link to="/recipes/create" v-if="check">CREATE RECIPE</router-link>
                </li>
                <li class="navbar__item">
                    <a @click.stop="logout" v-if="check">LOGOUT</a>
                </li>
            </ul>
        </div>
        <div class="flash flash__success" v-if="flash.success">
            {{ flash.success }}
        </div>
        <div class="flash flash__error" v-if="flash.error">
            {{ flash.error }}
        </div>
        <router-view></router-view>
    </div>
</template>
<script type="text/javascript">
    import Flash from './helpers/flash'
    import Auth from './store/auth'
    import { post } from './helpers/api'

    export default {
        created() {
            Auth.initialize()
        },
        data() {
            return {
                flash: Flash.state,
                auth: Auth.state
            }
        },
        computed: {
            check() {
                return this.auth.api_token && this.auth.user_id ? true : false
            }
        },
        methods: {
            logout() {
                post(`/api/logout`).then((res) => {
                    if(res.data.logged_out){
                        Auth.remove()
                        Flash.setSuccess('You Have successfully logged out!')
                        this.$router.push('/login')
                    }
                })
            }
        }
    }
</script>
