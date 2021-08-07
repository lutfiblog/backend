import mongoose from 'mongoose';

const controlSchema = mongoose.Schema({
    id1: String,
    id2: String,
    id3: String,
    id4: String,
    createdAt: {
        type: Date,
        default: new Date(),
    },
})

var controlMessage = mongoose.model('controlMessage', controlSchema);

export default controlMessage;