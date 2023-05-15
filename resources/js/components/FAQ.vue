<template>
    <div>
        <div class="container">
            <h1>Frequently Asked Questions</h1>
            <br>
            <details>
                <summary>Where can I subscribe to your newsletter?</summary>
                <div class="faq-details">
                    <p>
                        We often send out our newsletter with news and great offers. We will never disclose your data to third parties and you can unsubscribe from the newsletter at any time. Subscribe here to our newsletter.
                    </p>
                </div>
            </details>
            <details>
                <summary>Where can I edit my billing and shipping address?</summary>
                <div class="faq-details">
                    <p>
                        If you created a new account after or while ordering you can edit both addresses (for billing and shipping) in your customer account.
                    </p>
                </div>
            </details>
            <details>
                <summary>Are unsold magazines sent back to the publisher?</summary>
                <div class="faq-details">
                    <p>
                        We usually sell all copies of the magazines offered in our shop. Some publishers and distributors offer the retailer the option of returning any unsold magazines. However, because our range includes magazines from countries such as Australia, the USA and the United Kingdom, sending them back would involve considerable effort in terms of logistics and would also be very expensive. We therefore choose not to return any unsold magazines. At the same time, this allows us to also offer our customers older or out-of-print magazines.
                    </p>
                </div>
            </details>
            <details>
                <summary>What criteria must a magazine meet in order to be included in your range?</summary>
                <div class="faq-details">
                    <p>
                        A magazine must meet various criteria before we can include it in our range:

                        In line with our business concept, the most important factor is that the publication is an independent magazine. All magazines in our range are independent and do not belong to a large publishing group.
                        We pay special attention to how the magazine looks and what type of paper is used to make it (FSC-certified).
                        We don’t sell glossy magazines on subjects such as luxury goods or cosmetics.
                        We don’t include publications in our range that glorify violence or weapons, nor ones with racist content or a certain political leaning.
                        The magazine should cover one of the following topics: design, architecture, photography, art, culture, music, food, community, society, nature, sports, sustainability. We don’t consider magazines that focus purely on lifestyle, fashion or beauty.
                        We must then ensure that we find the right target group and readership for all of our magazines.

                        If you would like to sell your magazine through our shop: form for publisher enquiries.
                    </p>
                </div>
            </details>
        </div>
    </div>
</template>

<script>

export default {
    components: {},

    data: function () {
        return {
            counselors: [],
            evaluations: [],
            apiResponse: {
                data: null,
                success: false,
                show: false
            },
            loading: true,
            selectedCounselor: {
                name: ''
            },

        }
    },
    mounted() {
        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.getCounselors();
    },
    methods: {
        getCounselors: function () {
            axios.get('/api/counselors')
                .then(response => {
                    this.counselors = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error);
                })
        },
    }


}
</script>

<style lang="scss" scoped>
.chat-app {
    display: flex;
}
body{
    margin-top:20px;
    background:#eee;
}
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap');

body{
    background-color: #000;
    font-family: 'Open Sans', sans-serif;
}

.container h1{
    color: #fff;
    //text-align: center;
}

details {
    background-color: #18181654;
    color: #fff;
    font-size: 1.5rem;
    border-radius: 3px;
}

summary {
    padding: .5em 1.3rem;
    list-style: none;
    display: flex;
    justify-content: space-between;
    transition: height 1s ease;
}

summary::-webkit-details-marker {
    display: none;
}

summary:after {
    content: "\002B";
}

details[open] summary {
    border-bottom: 1px solid #aaa;
    margin-bottom: .5em;
}

details[open] summary:after {
    content: "\00D7";
}

details[open] div {
    padding: .5em 1em;
}
.faq-details {
    font-size: 16px;
}
</style>
