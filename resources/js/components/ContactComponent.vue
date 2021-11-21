<template>
    <b-list-group-item class="py-1" href="#" :variant="variant" >
        <b-row class="p-2" align-h="center">
            <b-col cols="12" md="4" class="text-center">
                <b-img blank blank-color="#777" width="55" height="55" class="m-1" rounded="circle"
                    alt="Your friend">
                </b-img>
            </b-col>
            <b-col cols="5" align-self="center" class="d-none d-md-block">
                <p class="mb-0">{{name}}</p>
                <p class="text-muted small">{{lastMessage}}</p>
            </b-col>
            <b-col cols="3" align-self="center" class="d-none d-md-block">
                <p class="text-muted small mb-1">{{time}}</p>
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
            }
        },
        data() {
            return {
                name: 'Fernando Rubio',
                lastMessage: 'Tú: Adios',
                time: '10:00 PM',
            }
        },
    }
</script>
