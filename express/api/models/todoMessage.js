import mongoose from 'mongoose';

const postSchema = mongoose.Schema({
    title: String,
    message: String,
    createdAt: {
        type: Date,
        default: new Date(),
    },
})

var PostMessage = mongoose.model('todoMessage', postSchema);

export default PostMessage;