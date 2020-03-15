<template>
    <section id="dashboard-analytics">
        <search-banner />
        <live-feed />
    </section>
</template>

<script>
import LiveFeed from './partials/LiveFeed'
import SearchBanner from './partials/SearchBanner'

export default {
    components: {
        LiveFeed,
        SearchBanner
    },
}
</script>
