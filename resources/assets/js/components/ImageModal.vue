<template>

    <div class="modal is-active">

        <div class="modal-background"></div>

        <div class="modal-content">

            <div class="box">

                <img :src="src">

            </div>

        </div>

        <button class="modal-close is-large" aria-label="close" @click="$emit('close')"></button>

    </div>

</template>

<script>
    export default {
        props: ['src']
    }
</script>

