<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Settings</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3>Questions</h3>
                            </div>
                            <div class="col-xs-6">
                                <config-item :path="'total_questions'"></config-item>
                            </div>
                            <div class="col-xs-6">
                                <config-item :path="'max_question_score'"></config-item>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Time</h3>
                        <config-item :path="'max_route_score'"></config-item>
                        <!--<config-item :path="'point_reduction_per_minute'"></config-item>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Help</h3>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Emergency</h4>
                            </div>
                            <div class="col-xs-6">
                                <config-item :path="'total_emergencies'"></config-item>
                            </div>
                            <div class="col-xs-6">
                                <config-item :path="'emergency_penalty'"></config-item>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Hints</h4>
                            </div>
                            <div class="col-xs-6">
                                <config-item :path="'total_hints'"></config-item>
                            </div>
                            <div class="col-xs-6">
                                <config-item :path="'hint_penalty'"></config-item>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import ConfigItem from '../components/settings/Config'
    export default {
        components: {
            ConfigItem
        }
    }
</script>