<template>
    <div>
        <div class="row">

            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Group Position</div>
                    <div class="panel-body">
                        <template>
                            <group-position />
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>


<script>
    import GroupPosition from '../components/charts/groupposition'
    export default {
        components: { GroupPosition },
    }
</script>