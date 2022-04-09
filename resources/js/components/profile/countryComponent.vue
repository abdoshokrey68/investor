<template>
    <div>
        <select name="country" class="form-select" aria-label="Default select example">
            <option disabled selected> Select Your Country </option>
            <option class="text-uppercase"
                        v-for="country in mycountrus"
                        :key="country.index"
                        :value="country"
                        :selected="getSelected(country)" > {{country}} </option>
        </select>
    </div>
</template>

<script>
export default {
    name: 'CountryComponent',
    props: ['countrys', 'old_value'],
    data: function () {
        return {
            mycountrus: JSON.parse(this.countrys),
        }
    },
    mounted() {
        console.log('Countrys Component');
    },
    methods: {
        getSelected(country) {
            if (country == this.old_value) {
                return 'selected';
            }
        }
    }
}
</script>
