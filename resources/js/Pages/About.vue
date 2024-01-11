<script>
import { Link } from '@inertiajs/vue3';
export default{
        components:{
        Link
    }
}
</script>

<template>
    <div>Próximamente...</div>
    <Link :href="route('resources')">Resources</Link>
</template>
