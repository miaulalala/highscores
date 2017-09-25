<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Highscores/div>

                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered"> 
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Name</th>
                                    <th>Difficulty</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbdoy>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
