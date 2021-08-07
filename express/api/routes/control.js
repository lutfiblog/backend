import express from 'express';

import { getPosts, getPost, createPost, updatePost, deletePost } from '../controllers/controlController.js';

const router = express.Router();

router.get('/test', (req, res)=>{
    res.send('halo test');
});
router.get('/', getPosts);
router.post('/', createPost);
router.get('/:id', getPost);
router.patch('/:id', updatePost);
router.delete('/:id', deletePost);

export default router;