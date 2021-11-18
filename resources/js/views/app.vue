<template>
  <div>
    <div class="table col-sm-6">
        <div class="input-group stylish-input-group">
            <input v-model="search"  type="text" class="mb-2 form-control"  placeholder="Search a video" >
        </div>
        </div>
            <div class="col-8 margin-top">
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Name</th>
                    <th scope="col">Video</th>
                    <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="video in videos" v-bind:key="video.id">
                        <td><img v-bind:src="video.thumbnail_small"></td>
                        <td><a v-bind:href="baseUrl +'/video/' + video.slug + '/' + video.id">{{ video.title }}</a></td>
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
            }
        }
    }
</script>
