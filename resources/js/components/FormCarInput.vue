<template>
    <div class="form-group carInput">
        <div class="row align-items-end">
            <div class="col">
                <label for="carNumber"></label>
                <input type="text"
                       name="cars"
                       class="form-control"
                       aria-describedby="numberHelp">
            </div>
            <div class="col">
                <label for="carDriver"></label>
                <input type="text"
                       name="cars"
                       class="form-control"
                       aria-describedby="driverHelp">
            </div>
            <div class="col">
                <button v-on:click="doSome" type="button"
                        id="rr"
                        class="btn btn-danger">
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                count: 0
            }
        },
        methods: {

                addNewCarInput() {
                   this.count++;
                   console.log(this.count);
                },
                removeCarInput() {
                   this.count--;
                   console.log(this.count);
                }
        }
    }
</script>
