import { Body, Controller, Delete, Get, NotFoundException, Param, Patch, Post, Query } from '@nestjs/common';
import { CreateMovieDto } from './dto/create-movie.dto';
import { UpdateMovieDto } from './dto/update-movie.dto';
import { Movie } from './entities/movie.entity';
import { MoviesService } from './movies.service';

@Controller('movies')
export class MoviesController {

  constructor(private readonly moviesService: MoviesService) {}

  @Get()
  getAll() :Movie[]{
    return this.moviesService.getAll();
  }

  @Get("search")
  search(@Query("year") searchingYear: string){
      return `we are searching for a movie with a title: ${searchingYear}`;
  }

  @Get('/:id')
  getOne(@Param('id') MovieId: number) {
    return this.moviesService.getOne(MovieId);

  }

  @Post()
  create(@Body() MovieData: CreateMovieDto) {
    return this.moviesService.create(MovieData);
  }

  @Delete('/:id')
  remove(@Param('id') MovieId: number) {
      return this.moviesService.deleteOne(MovieId);
  }

  @Patch('/:id') //update
  patch(@Param('id') MovieId: number, @Body() updateData: UpdateMovieDto) {
    return this.moviesService.update(MovieId, updateData);
  }

}
