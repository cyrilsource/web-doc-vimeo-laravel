<template>
    <div>
        <div class="table col-4">
            <div class="col-4">
                <input v-model="search"  @keyup="searchIt" type="text" class="mb-2 form-control"  placeholder="Search a video" >
            </div>
        </div>
        <div class="margin-top">
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Thumbnail</th>
                <th scope="col">Name</th>
                <th scope="col">Themes</th>
                <th scope="col">Video</th>
                <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="video in videos" v-bind:key="video.id">
                    <td><img v-bind:src="video.thumbnail_small"></td>

                    <td><a v-bind:href="baseUrl +'/video/' + video.slug + '/' + video.id">{{ video.title }}</a></td>
                     <td>
                         <em v-for="theme in video.themes" v-bind:key="theme.id">{{ theme.name }}, </em>
                    </td>
                    <td><a v-bind:href="video.link">link on vimeo</a></td>
                    <td><a v-bind:href="baseUrl +'/admin/' + video.id" class="btn btn-info" role="button" aria-pressed="true">Edit</a></td>
                </tr>
                <tr>
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
                baseUrl: 'coucou'
            }
        },

        created() {
            this.fetchVideos();
            this.getUrl();
        },

        methods: {
            fetchVideos() {
                fetch('api/videos')
                .then(res => res.json())
                .then(res => {
                    this.videos = res.data
                })
            },
            getUrl() {
                var baseUrl = window.location.origin
                this.baseUrl = baseUrl
            },
            searchIt: _.debounce(function(){
                let query = this.search
                fetch('api/findVideo?q='+ query)
                .then(res => res.json())
                .then(res => {
                    this.videos = res.data
                })
            }, 500)
        }
    }
</script>
