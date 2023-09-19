<template>
    <div>
        <div v-for="message in messages" :key="message.sid">
            {{ message.author }}: {{ message.body }}
        </div>
        <input
            v-model="newMessage"
            @keydown.enter="sendMessage"
            placeholder="Type a message..."
        />
    </div>
</template>

<script>
import { Chat, Client} from "twilio-chat";


export default {
    data() {
        return {
            chatClient: null,
            channel: null,
            messages: [],
            newMessage: "",
        };
    },
    async mounted() {
        try {
            const TWILIO_ACCOUNT_SID = "AC6f4c893c55bb9960408902b09ced4636";
            const TWILIO_AUTH_TOKEN = "9645430d9efd134a4f35c13f80068443";


            const client = new Client(TWILIO_AUTH_TOKEN);
            client.on("stateChanged", (state) => {
                if (state === "failed") {
                    // The client failed to initialize
                    return;
                }

                if (state === "initialized") {
                    
                }
            });
            console.log(client);
            
            // Create a Chat client
            this.chatClient = await Chat.create({
                tokenProvider: {
                    type: "static",
                    token: TWILIO_AUTH_TOKEN,
                },
            });

            // Join an existing channel (replace 'general' with your channel name)
            this.channel = await this.chatClient.getChannelByUniqueName(
                "general"
            );

            if (!this.channel) {
                // If the channel doesn't exist, create it
                const newChannel = await this.chatClient.createChannel({
                    uniqueName: "general",
                });

                // Join the newly created channel
                await newChannel.join();
                this.channel = newChannel;
            } else {
                // Join the existing channel
                await this.channel.join();
            }

            // Receive messages (add an event listener)
            this.channel.on("messageAdded", (message) => {
                // Handle incoming messages
                this.messages.push(message);
            });
        } catch (error) {
            console.error("Twilio Chat initialization error:", error);
            // Handle the error, e.g., by displaying a user-friendly message to the user.
        }
    },
    methods: {
        async sendMessage() {
            try {
                const message = await this.channel.sendMessage(this.newMessage);
                this.newMessage = "";
            } catch (error) {
                console.error("Error sending message:", error);
                // Handle the error, e.g., by displaying a user-friendly message to the user.
            }
        },
    },
};
</script>
