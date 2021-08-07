import { Module } from '@nestjs/common';
import { UsersController } from './users/users.controller';
import { MoviesModule } from './movies/movies.module';

@Module({
  imports: [MoviesModule],
  controllers: [UsersController],
  providers: [],
})
export class AppModule {}
