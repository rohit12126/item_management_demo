<template>
    <div class="main-container">
        
        <div class="main-title">This is Contact page</div>
        <div class="common-text">
            Text Lipsum has one of the oldest random text generators on the network, fastest and most accurate. For developers who need to fill in texts with a mockup, simply click on 'Generate Text Lorem Ipsum' and it provides a Latin esthetic with five paragraphs of a correctly formatted text. Or use the other customization options.  Lorem ipsum is generally referred to as a filler text or dummy text that is derived from the Latin language. Significantly, the dummy text is used in documents and website design to check the overall appearance of the website or design. It started flying high after the 1960s as the famous Letraset sheets are filled with lorem ipsum. Moreover, this sample dummy text is been used since the 15th century till now in the typewriting and designing sector.
        </div>
    </div>
</template>

<script>
import DefaultLayout from '../layouts/DefaultLayout'
export default {
    name : 'ContactComponent',
    created() {
        this.$emit('update:layout', DefaultLayout);
    },
}
</script>