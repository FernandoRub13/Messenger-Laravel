<template>
    <b-list-group-item class="py-1" href="#" :variant="variant" >
        <b-row class="p-2" align-h="center">
            <b-col cols="12" md="4" class="text-center">
                <b-img blank blank-color="#777" width="55" height="55" class="m-1" rounded="circle"
                    alt="Your friend">
                </b-img>
            </b-col>
            <b-col cols="5" align-self="center" class="d-none d-md-block">
                <p class="mb-0">
                    <status-component :online="conversation.online" />
                    {{conversation.contact_name}}
                </p>
                
                <p class="text-muted small">{{conversation.last_message}}</p>
            </b-col>
            <b-col cols="3" align-self="center" class="d-none d-md-block">
                <p class="text-muted small mb-1">{{ last_time }}</p>
                
            </b-col>
        </b-row>
    </b-list-group-item>

</template>

<script>
    
    export default {
        
        props: {
            variant: {
                type: String,
                default: ''
            },
            conversation: {
                type: Object,
                default: () => ({})
            }
        },
        data() {
            return {
            }
        },
        computed: {
            last_time() {
                var time = moment.utc(this.conversation.last_time).tz('America/Mexico_City');
                return time.locale('es').fromNow();
            }
        },
    }
</script>
