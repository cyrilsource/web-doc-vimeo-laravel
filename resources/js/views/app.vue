<template>
    <div>
        <div class="row">
            <div class="col-4">
                <input v-model="search"  @keyup="searchIt" type="text" class="mb-2 form-control"  placeholder="Search a video" >
            </div>
            <div class="col-6">
                <strong>Number of videos: {{ count }}</strong>
            </div>
        </div>

        <div class="margin-top col-11">
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Thumbnail</th>
                <th scope="col">Name</th>
                <th scope="col">Text ?</th>
                <th scope="col">PDF</th>
                <th scope="col">Themes</th>
                <th scope="col">Video</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="video in videos" v-bind:key="video.id">
                    <td><img v-bind:src="video.thumbnail_small"></td>
                    <td><a v-bind:href="baseUrl +'/video/' + video.slug + '/' + video.id">{{ video.title }}</a></td>
                    <td v-if="video.description !== null" style="color: #31D2F2;">YES</td>
                    <td v-else style="color: #BB2D3B;">NO</td>
                    <td>
                        <a :href="baseUrl+'/storage/pdf/theme/'+video.pdf">{{video.pdf}}</a>
                        <form v-if="video.pdf !== null" v-bind:action="baseUrl +'admin/deleteVideoPdf/'+video.id" method="post">
                            <input type="hidden" name="_token" :value="csrf">
                            <button type="submit" class="btn btn-danger">Delete pdf</button>
                        </form>
                    </td>
                     <td>
                         <em v-for="theme in video.themes" v-bind:key="theme.id">{{ theme.name }}, </em>
                    </td>
                    <td><a v-bind:href="video.link">link on vimeo</a></td>
                    <td><a v-bind:href="baseUrl +'admin/editVideo/' + video.id" class="btn btn-info" role="button" aria-pressed="true">Edit</a></td>
                    <td>
                        <form v-bind:action="baseUrl +'admin/deleteVideo/'+video.id" method="post">
                            <input type="hidden" name="_token" :value="csrf">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</template>
<script>
//https://stackoverflow.com/questions/42814679/vuejs-2-uncaught-referenceerror-is-not-defined-with-debounce
import _ from 'lodash';

    export default {
        data() {
            return {
                videos: [],
                video: {
                    id: '',
                    title: '',
                    slug: '',
                    thumbnail_small: '',
                    link: '',
                    vimeo_id: ''
                },
                search: '',
                baseUrl: '',
                csrf: '',
                count: ''
            }
        },

        created() {
            this.fetchVideos()
            this.getUrl()
            this.getCsrf()
        },

        methods: {
            fetchVideos() {
                fetch('api/videos')
                .then(res => res.json())
                .then(res => {
                    this.videos = res.data
                    this.count = res.data.length
                })
            },
            getUrl() {
                var baseUrl = window.location.origin + '/terrecommune/public/'
                this.baseUrl = baseUrl
            },
            getCsrf() {
                var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                this.csrf = csrf
            },
            searchIt: _.debounce(function(){
                let query = this.search
                fetch('api/findVideo?q='+ query)
                .then(res => res.json())
                .then(res => {
                    this.videos = res.data
                    this.count = res.data.length
                })
            }, 500)
        }
    }
</script>
